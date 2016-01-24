<?php
// Application middleware

// e.g: $app->add(new \Slim\Csrf\Guard);

class Auth {

	public $user;

    public function __construct() {
    }

    public function __invoke($request, $response, $next) {

		$uri = $request->getUri();

		$publicMethod = require __DIR__ . '/publicMethod.php';

		$isPublic = false;
		foreach ($publicMethod as $key => $value) {
			if($uri->getPath() == $value['path'] && $request->getMethod() == strtoupper($value['method'])) {
				$isPublic = true;
				break;
			}
		}

		if(!$isPublic) {
			$authToken = $request->getHeaderLine('HTTP_API_KEY');
			if($authToken) {
				$user = $this->authenticate($authToken);
				if(!$user) {
					$res = [
						'status' => [
							'code' => 401,
							'error' => true,
							'message' => 'Unauthorized'
							]
						];
				 	return $response->write(json_encode($res, JSON_UNESCAPED_SLASHES))->withStatus(401);
				}
				$request = $request->withAttribute('user', $user);
			} else {
				$res = [
					'status' => [
						'code' => 401,
						'error' => true,
						'message' => 'Unauthorized'
						]
					];
			 	return $response->write(json_encode($res, JSON_UNESCAPED_SLASHES))->withStatus(401);
			}
    	}

        return $next($request, $response);
    }


    protected function authenticate($authToken)
	{
		$user = Model::factory('User')->where('api_key', $authToken)->find_one();

	    if (false != $user) {
	        return $user;
	    }
	    
	    return false;
	}
}

class RequestJSON {
    public function __construct() {
    }

    public function __invoke($request, $response, $next) {

		$contentType = $request->getContentType();
        if ($contentType != 'application/json' ) {
			$res = [
				'status' => [
					'code' => 400,
					'error' => true,
					'message' => 'content type must be json'
					]
				];
		 	return $response->write(json_encode($res, JSON_UNESCAPED_SLASHES))->withStatus(400);
        }

        return $next($request, $response);
    }
}

$app->add(new Auth);
$app->add(new RequestJSON);