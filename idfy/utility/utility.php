<?php
/*
Request object initiation and validation
*/
set_include_path(realpath(dirname(__FILE__)));
require(dirname(__FILE__) . '/../errors.php');
require(dirname(__FILE__) . '/../constants/tasks.php');

class Utility extends Tasks{
/*
    API request-object initiation and validation module
*/
    var $DEFAULTS;
    var $task_id;
    var $task_type;
    var $data;
    var $group_id;

    function __construct(string $task__type,string $task__id, array $data_, $group__id=NULL){
        
        $tasks = Tasks::$_tasks_config;
        // print_r($tasks);
        $this -> DEFAULTS['tasks_config'] = $tasks;
        $this -> task_id = $task__id;
        $this -> task_type = $task__type;
        $this -> data = $data_;
        $this -> group_id = $group__id;
    }

    function update_api_body(){
        /*
        Update the api_body 
        :return: updated req_body
        */
        $req_body = array(
                        'tasks'=>array(array(
                                    'type'=> $this->task_type,
                                    'task_id'=> $this->task_id,
                                    'data'=> $this->data)));
        
        if ($this->group_id){
            $req_body['tasks'][0]['group_id'] = $this->group_id;
        }

        return json_encode($req_body);
    }

    function validate_request_data(string $api_version){
        /*
        validate request_data. Checks presence of mandate_fields
        :param data: part of request_body
        :param task_type: task_type
        :return: None
        */

        $all_task_data_fields = array();
        $input_data_keys = array_keys($this->data);

        $task_schema = $this->DEFAULTS['tasks_config'][$api_version]['data_schema'][$this->task_type];
        $mandate_task_data_fields = $task_schema['mandate_fields'];

        if ($mandate_task_data_fields){
            $all_task_data_fields = array_merge($all_task_data_fields,$mandate_task_data_fields);

            foreach ($mandate_task_data_fields as $key){
                if (!in_array($key, $input_data_keys)){
                    throw new BadRequestError("Insufficient data fields provided \n". implode("\t",$mandate_task_data_fields));
                }
            }

        }
        $optional_task_data_fields = $task_schema['optional_fields'];

        if ($optional_task_data_fields){
            $all_task_data_fields = array_merge($all_task_data_fields,$optional_task_data_fields);
        }

        $any_task_data_fields = $task_schema['any'];
        if ($any_task_data_fields){
            $all_task_data_fields = array_merge($all_task_data_fields,$any_task_data_fields);

            $any_fields_flag = FALSE;

            foreach ($any_task_data_fields as $key){
                if (in_array($key, $input_data_keys)){
                    $any_fields_flag = TRUE;
                    break;
                }
            }

            if (!$any_fields_flag){
                throw new BadRequestError("Insufficient data fields provided. Expected any of these fields \n".implode(" ",$any_task_data_fields));
            }

        }

        //Checking if any extra fields provided which are not required
        foreach ($input_data_keys as $key){
            if (!in_array($key, $all_task_data_fields)){
                throw new BadRequestError("Unexpected data field provided in data ".$key." in ".implode(" ",$this->data)."\n"."Acceptable fields - ".implode(" ",$all_task_data_fields));
            }
        }

    }

    function validate_request_arguments( $api_version){
        /*
        Validate json_body part of the api_request
        :param task_type: task_type
        :param task_id: task_id
        :param data: part of request_body
        :param api_version: v2/v3
        :param group_id: group_id
        :return: req_body
        */
        // print_r ($this->data);
        // print_r ($this->DEFAULTS['tasks_config'][$api_version]['data_schema']);
        // print_r ($this-> task_type);
        if (($this->check_dict($this -> data))){
            throw new BadRequestError("Invalid data format. Expected format is associative array, eg: array('doc_url'=> '<URL>') or ['doc_url' => '<URL>']");
        }
        elseif (sizeof($this->data) == 0){
            throw new BadRequestError("Empty data provided.");
        }
        if (!is_string($this->task_id)){
            throw new BadRequestError("Invalid task_id format. Expected format is string, eg: '<TASK_ID>'");
        }
        elseif (strlen($this->task_id) == 0){
            throw new BadRequestError("Empty task_id provided.");
        }
        if (!is_string($this->task_type)){
            throw new BadRequestError("Invalid task_id format. Expected format is string, eg: '<TASK_ID>'");
        }
        elseif (strlen($this->task_type) == 0){
            throw new BadRequestError("Empty task_type provided. Refer the doc for task_types -   https://api-docs.idfy.com/v2/#task-types");
        }
        elseif (!array_key_exists($this->task_type,$this->DEFAULTS['tasks_config'][$api_version]['available_tasks'])){
            throw new BadRequestError("Invalid task_type requested. Refer the doc for task_types - ".
            "https://api-docs.idfy.com/v2/#task-types");
        }
        if (isset($this->group_id)){
            if (!is_string($this->group_id)){
                throw new BadRequestError("Invalid group_id format. Expected format is string, eg: '<GROUP_ID>'");
            }
        }
        $this -> validate_request_data($api_version);
        $req_body = $this->update_api_body();

        return $req_body;
    }

    //Function to check if given input is an associative array (i.e., A dict)
    function check_dict($input){
        if (!is_array($input)){
            return FALSE;
        }

        return count(array_unique(array_map("is_string", array_keys($input)))) >= 2;

    }

    
}

