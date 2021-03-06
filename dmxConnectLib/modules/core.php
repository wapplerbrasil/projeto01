<?php

namespace modules;

use \lib\core\Module;
use \lib\core\Scope;
use \lib\core\FileSystem;

class core extends Module
{
    public function repeat($options) {
		option_require($options, 'repeat');

        $repeater = $this->app->parseObject($options->repeat);

        if ($repeater === NULL) {
            return;
        }

        if (is_bool($repeater)) {
            $repeater = $repeater ? array(0) : array();
        }

        if (is_string($repeater)) {
            $repeater = str_split($repeater);
        }

        if (is_numeric($repeater)) {
            $repeater = range(0, $repeater - 1);
        }

        if (!(is_array($repeater) || is_object($repeater))) {
            throw new \Exception('Repeater data is not an array or object.');
        }

        $index = 0;
        $data = array();
        $appData = $this->app->data;

        foreach ($repeater as $key => $value) {
            $this->app->data = array();

            if (isset($options->outputFields) && is_array($options->outputFields)) {
                if (is_array($value) || is_object($value)) {
                    foreach ($value as $k => $v) {
                        if (in_array($k, $options->outputFields)) {
                            $this->app->data[$k] = $v;
                        }
                    }
                }
            }

            $scope = is_array($value) || is_object($value) ? (array)$value : array();
            //$scope['$repeat'] = $repeater;
            $scope['$key'] = $key;
            $scope['$name'] = $key;
            $scope['$value'] = $value;
            $scope['$index'] = $index;
            $scope['$number'] = $index + 1;
            $scope['$oddeven'] = $index % 2;

            $this->app->scope = new Scope($this->app->scope, $scope);
            $this->app->exec($options->exec, TRUE);
            if ($this->app->scope->parent === NULL) {
                throw new \Exception('Error.');
            }
            $this->app->scope = $this->app->scope->parent;

            $data[] = $this->app->data;

            $index++;
        }

        $this->app->data = $appData;

        return $data;
    }

    public function _while($options) {
        option_require($options, array('while', 'exec'));

        while ($this->app->parseObject($options->while)) {
            $this->app->exec($options->exec, TRUE);
        }
    }

    public function condition($options) {
		option_require($options, array('if', 'then'));

        if ($this->app->parseObject($options->if)) {
            $this->app->exec($options->then, TRUE);
        } elseif (isset($options->else)) {
            $this->app->exec($options->else, TRUE);
        }
    }

    public function setvalue($options) {
		option_require($options, 'value');

        $options = $this->app->parseObject($options);

        if (isset($options->key) && $options->key <> '') {
            $this->app->scope->global->set($options->key, $options->value);
        }

        return $options->value;
    }

    public function setsession($options, $name) {
        $value = $this->app->parseObject($options->value);

        $this->app->session->set($name, $value);
        $this->app->scope->global->set('$_SESSION', $this->app->session);
    }

    public function removesession($options, $name) {
        $this->app->session->remove($name);
        $this->app->scope->global->set('$_SESSION', $this->app->session);
    }

    public function setcookie($options, $name) {
        $options = $this->app->parseObject($options);
        $this->app->response->setCookie($name, $options->value, $options);
    }

    public function removecookie($options, $name) {
        $options = $this->app->parseObject($options);
        $this->app->response->clearCookie($name, $options);
    }

    public function response($options) {
		option_require($options, 'data');

        $options = $this->app->parseObject($options);

        if (!isset($options->status) || !is_int($options->status)) {
            $options->status = 200;
        }

        $this->app->response->end($options->status, $options->data);
    }

    public function error($options) {
		option_require($options, 'message');

        $this->app->response->error($options->message);
    }

    public function redirect($options) {
        option_require($options, 'url');

        header('Location: ' . $this->app->parseObject($options->url));
        exit();
    }

    public function trycatch($options) {
        option_require($options, 'try');

        try {
            $this->app->exec($options->try, TRUE);
        } catch(\Exception $error) {
            $this->app->scope->set('$_ERROR', $error->getMessage());
            $this->app->error = FALSE;
            if (isset($options->catch)) {
                $this->app->exec($options->catch, TRUE);
            }
        }
    }

    public function exec($options) {
        option_require($options, 'exec');

        $data = array();

        $path = realpath($this->app->get('ACTIONS_URL', BASE_URL . '/../dmxConnect/modules/lib/' . $options->exec . '.php'));
		if (FileSystem::exists($path)) {
            $appData = $this->app->data;
            $this->app->data = array();
            $scope = array();
            $scope['$_PARAM'] = isset($options->params) ? $this->app->parseObject($options->params) : array();
            $this->app->scope = new Scope($this->app->scope, $scope);
			require(FileSystem::encode($path));
            $this->app->exec(json_decode($exports), TRUE);
            $data = $this->app->data;
            $this->app->scope = $this->app->scope->parent;
            $this->app->data = $appData;
		} else {
            throw new \Exception('There is no action called ' . $options->exec . ' found in the library.');
        }

        return $data;
}
}
