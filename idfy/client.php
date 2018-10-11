<?php
// include '../errors.php';
// include '../constants/tasks.php';

set_include_path(realpath(dirname(__FILE__)));
// require(dirname(__FILE__) . '/errors.php');
// require(dirname(__FILE__) . '/constants/tasks.php');
require(dirname(__FILE__) . '/constants/url.php');
require(dirname(__FILE__) . '/utility/utility.php');

class Client extends Tasks{

    var $DEFAULTS;
    var $auth;
    var $base_url;
    var $headers;

    function __construct($autho,array $options=NULL){

        $this -> DEFAULTS['base_url_v2'] = Url::$BASE_URL_V2;
        $this -> DEFAULTS['base_url_v3'] = Url::$BASE_URL_V3;
        $this -> DEFAULTS['headers'][0] = 'Content-Type: application/json';
        array_push($this->DEFAULTS['headers'],"apikey: ".($autho));
        $this -> auth = $autho;
        $this -> base_url = $this -> set_base_url($options);
        
        if ($options!=NULL){
            $this -> headers = $this -> validate_headers($options);
        }else{
            $this-> headers = $this->DEFAULTS['headers'];
        }
        
        
    }

    private function set_base_url(array $options=NULL){
        /*
        Set the api_endpoint based on client's initiation
        :param options: dict obj
        :return: api_endpoint url
        */
        $api_endpoint = $this -> DEFAULTS['base_url_v2'];       
        if ($options != NULL){
            if (array_key_exists('url', $options)){
                if (!is_string($options['url'])){
                    throw new BadRequestError('URL is not a string');
                }
                else{
                    $api_endpoint = $options['url'];
                }
            }
        }
        return $api_endpoint;
    }

    private function validate_headers($option){
    /*
        Validate headers and update headers if provided during client initiation
        :param options: kwargs
        :return: headers
    */
        if (array_key_exists('headers', $option)){
            if (is_array($option['headers'])){
                if (!array_key_exists('apikey',$option['headers'])){
                    
                    throw new BadRequestError("No API-key provided. client_1 = Client('<YOUR_API_KEY>')");
                }
                //Update self.headers
                foreach ($option['headers'] as $key=>$value)
                {   
                   
                    array_push($this -> DEFAULTS['headers'],$key.": ". $value);
  
                }
                // 
            }
            else{
                throw new BadRequestError('Invalid headers provided. 
                Correct format: array ("content-Type"=> "application/json")');
            }
        }
        return $this -> DEFAULTS['headers'];
    }

    public function post_request(string $task_type,string $task_id, array $data, $group_id=NULL){
    /*
        post_request to EVE-API
        :param task_type: task_type
        :param task_id: task_id
        :param data: part of the request_body
        :param group_id: group_id
        :return: API_request's request_id and status
    */
        $req_obj = new Utility($task_type, $task_id, $data, $group_id);
        $req_body = $req_obj->validate_request_arguments($api_version="v2");
        $url = $this->DEFAULTS['base_url_v2'];
        
        //Making POST request
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => $this->base_url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $req_body,
        CURLOPT_HTTPHEADER => $this->headers
        ));
        
        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
        echo "cURL Error #:" . $err;
        } else {
        echo $response;
        }
        
        return $response;
    
    }

    public function get_response($request_id=NULL, $group_id=NULL, $task_id=NULL){
    /*
        get request to retrieve response from EVE-API with request_id
        :param request_id: request_id
        :param group_id: group_id
        :param task_id: task_id
        :return: API_call's response
    */
        $params = array();
        if ($request_id == NULL && $group_id==NULL && $task_id==NULL){
            throw new BadRequestError("Invalid request. Provide atleast one of request_id, group_id or task_id.");
        } 
        if (!is_string($request_id) && $request_id!=NULL){
            throw new BadRequestError("Invalid request_id format. Expected format is string.");
        }
        if ($request_id!=NULL){
            $params['request_id'] = $request_id;
        }
        if (!is_string($group_id) && $group_id!=NULL){
            throw new BadRequestError("Invalid group_id format. Expected format is string.");
        }
        if ($group_id!=NULL){
            $params['group_id'] = $group_id;
        }
        if (!is_string($task_id) && $task_id!=NULL){
            throw new BadRequestError("Invalid task_id format. Expected format is string.");
        }
        if ($task_id!=NULL){
            $params['task_id'] = $task_id;
        }

        $dat = '';
        foreach($params as $key=>$val){
            $dat.=$key.'='.$val.'&';
        }
        $dat = trim($dat,'&');
        //Sending GET Request:
        $url = $this->DEFAULTS['base_url_v2'];
        $url = $url."?".$dat;
        // print_r ($url);
        
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => $this->headers
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
        echo "cURL Error #:" . $err;
        } else {
        echo $response;
        }
        return $response;
    }
     
}
// $aaa = new Client("77484e44-db92-4a64-9584-0cc1798cd44e",[]);

// print_r ($aaa -> post_request("pan_ocr","php11",array("doc_url"=>"https://s3-ap-southeast-1.amazonaws.com/addressify-demo/eve+api+images/PAN+LATEST/IMG_20171218_161405308.jpg"),"group"));
