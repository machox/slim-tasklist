<?php
// Routes

use Particle\Validator\Validator;

$app->get('/', function ($request, $response, $args){

    $res = [
    		'status' => [ 
    			'code' => 200, 
    			'error' => false, 
    			'message' => 'Welcome to the jungle...'
    			]
    		];

 	return $this->view->render($response, $res, 200);

});

// API group
$app->group('/api', function (){

    // Version group
    $this->group('/v1', function (){

        // Register user
        $this->post('/users', function ($request, $response, $args) {

			$params = $request->getParsedBody(); 		
			if(!$params) $params = [];	

			$v = new Validator;
			$v->required('email')->email();
			$v->required('password')->lengthBetween(5, 50)->alnum();

			$result = $v->validate($params);

			if(!$result->isValid()) {

				$error = $result->getMessages();
				$message = [];
				foreach ($error as $key => $msg) {
					foreach ($msg as $value) {
						$message[$key] = $value;
					}
				}
				$res = [
					'status' => [
						'code' => 400, 
						'error' => true, 
						'message' => $message
						]
					];
			 	return $this->view->render($response, $res, 400);
			}

			$exist = Model::factory('User')->where('email', $params['email'])->find_one();
			if($exist) {
				$res = [
					'status' => [
						'code' => 400, 
						'error' => true, 
						'message' => ['email' => 'email already added']
						]
					];
			 	return $this->view->render($response, $res, 400);
			}

			$user = Model::factory('User')->create();
			$user->email = $params['email'];
			$user->password = sha1($params['password'] . $params['email']);
			$user->api_key = sha1($user->password . time());
			if($user->save()) {
				$res = [
					'status' => [
						'code' => 200, 
						'error' => false, 
						'message' => 'add user successfully'
						]
					];
			 	return $this->view->render($response, $res, 200);
			} else {
				$res = [
					'status' => [
						'code' => 500, 
						'error' => true, 
						'message' => 'add user failed'
						]
					];
			 	return $this->view->render($response, $res, 500);
			}

        });

		//Login user
        $this->post('/sessions', function ($request, $response, $args) {

			$params = $request->getParsedBody();  
			if(!$params) $params = [];		

			$v = new Validator;
			$v->required('email')->email();
			$v->required('password');

			$result = $v->validate($params);

			if(!$result->isValid()) {

				$error = $result->getMessages();
				$message = [];
				foreach ($error as $key => $msg) {
					foreach ($msg as $value) {
						$message[$key] = $value;
					}
				}
				$res = [
					'status' => [
						'code' => 400, 
						'error' => true, 
						'message' => $message
						]
					];
			 	return $this->view->render($response, $res, 400);
			}

			$user = Model::factory('User')->where('email', $params['email'])->where('password', sha1($params['password'] . $params['email']))->find_one();
			if($user) {
				$res = [
					'status' => [
						'code' => 200, 
						'error' => false, 
						'message' => 'login successfully'
						],
					'results' => [
						'email' => $user->email, 
						'api_key' => $user->api_key
						]
					];
			 	return $this->view->render($response, $res, 200);
			} else {
				$res = [
					'status' => [
						'code' => 400, 
						'error' => true, 
						'message' => 'login failed'
						]
					];
			 	return $this->view->render($response, $res, 400);
			}
        });

        // add task
        $this->post('/tasks', function ($request, $response, $args) {

        	$auth = $request->getAttribute('user');
			$params = $request->getParsedBody();        		
			if(!$params) $params = [];	

			$v = new Validator;
			$v->required('name');

			$result = $v->validate($params);

			if(!$result->isValid()) {

				$error = $result->getMessages();
				$message = [];
				foreach ($error as $key => $msg) {
					foreach ($msg as $value) {
						$message[$key] = $value;
					}
				}
				$res = [
					'status' => [
						'code' => 400, 
						'error' => true, 
						'message' => $message
						]
					];
			 	return $this->view->render($response, $res, 400);
			}

			$task = Model::factory('Task')->create();
			$task->user_id = $auth->user_id;
			$task->name = $params['name'];
			$task->description = isset($params['description']) ? $params['description'] : null;
			if($task->save()) {
				$res = [
					'status' => [
						'code' => 200, 
						'error' => false, 
						'message' => 'add task successfully'
						]
					];
			 	return $this->view->render($response, $res, 200);
			} else {
				$res = [
					'status' => [
						'code' => 500, 
						'error' => true, 
						'message' => 'add task failed'
						]
					];
			 	return $this->view->render($response, $res, 500);
			}
        });

		//list task
        $this->get('/tasks', function ($request, $response, $args) {
			$params = $request->getQueryParams();
        	$auth = $request->getAttribute('user');
			$user = Model::factory('User')->find_one($auth->user_id);
			$count = $user->tasks()->count();
			$offset = 0;
			if(isset($params['offset']) && is_numeric($params['offset'])) {
				$offset = $params['offset'];
			}
			$limit = $count;
			if(isset($params['limit']) && is_numeric($params['limit'])) {
				$limit = $params['limit'];
			}
			$tasks = $user->tasks()->limit($limit)->offset($offset)->find_array();
			$res = [
				'status' => [
					'code' => 200, 
					'error' => false, 
					'message' => 'ok'
					],
				'metadata' => [
					'resultset' => [
					'count' => $count,
					'offset' => $offset,
					'limit' => $limit
					]
				],
				'results' => $tasks
				];
		 	return $this->view->render($response, $res, 200);

        });

        $this->get('/tasks/{id:[0-9]+}', function ($request, $response, $args) {
        	$auth = $request->getAttribute('user');
			$task = Model::factory('Task')->where('user_id', $auth->user_id)->find_one($args['id']);
			if($task) {
				$res = [
					'status' => [
						'code' => 200, 
						'error' => false, 
						'message' => 'ok'
						],
					'results' => $task->as_array()
					];
			 	return $this->view->render($response, $res, 200);
		 	} else {
				$res = [
					'status' => [
						'code' => 403, 
						'error' => true, 
						'message' => 'forbidden access'
						]
				];
		 		return $this->view->render($response, $res, 403);
		 	}

        });

        //update task
        $this->put('/tasks/{id:[0-9]+}', function ($request, $response, $args) {

        	$auth = $request->getAttribute('user');
			$params = $request->getParsedBody();
			if(!$params) $params = [];	

			$v = new Validator;
			$v->required('name');

			$result = $v->validate($params);

			if(!$result->isValid()) {

				$error = $result->getMessages();
				$message = [];
				foreach ($error as $key => $msg) {
					foreach ($msg as $value) {
						$message[$key] = $value;
					}
				}
				$res = [
					'status' => [
						'code' => 400, 
						'error' => true, 
						'message' => $message
						]
					];
			 	return $this->view->render($response, $res, 400);
			}

			$task = Model::factory('Task')->where('user_id', $auth->user_id)->find_one($args['id']);
			if($task) {
				$task->user_id = $auth->user_id;
				$task->name = $params['name'];
				$task->description = isset($params['description']) ? $params['description'] : $task->description;
				if($task->save()) {
					$res = [
						'status' => [
							'code' => 200, 
							'error' => false, 
							'message' => 'update task successfully'
							]
						];
				 	return $this->view->render($response, $res, 200);
				} else {
					$res = [
						'status' => [
							'code' => 500, 
							'error' => true, 
							'message' => 'update task failed'
							]
						];
				 	return $this->view->render($response, $res, 500);
				}
		 	} else {
				$res = [
					'status' => [
						'code' => 403, 
						'error' => true, 
						'message' => 'forbidden access'
						]
				];
		 		return $this->view->render($response, $res, 403);
		 	}
        });

        // delete task
        $this->delete('/tasks/{id:[0-9]+}', function ($request, $response, $args) {
        	$auth = $request->getAttribute('user');
			$task = Model::factory('Task')->where('user_id', $auth->user_id)->find_one($args['id']);
			if(!$task) {
				$res = [
					'status' => [
						'code' => 403, 
						'error' => true, 
						'message' => 'forbidden access'
						]
				];
		 		return $this->view->render($response, $res, 403);
			}
			if($task->delete()) {
				$res = [
					'status' => [
						'code' => 200, 
						'error' => false, 
						'message' => 'delete task successfully'
						]
					];
			 	return $this->view->render($response, $res, 200);
		 	} else {
				$res = [
					'status' => [
						'code' => 500, 
						'error' => true, 
						'message' => 'delete task failed'
						]
				];
		 		return $this->view->render($response, $res, 500);
		 	}
        });

    });

});