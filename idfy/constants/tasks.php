<?php
// set_include_path(realpath(dirname(__FILE__)));
// require(dirname(__FILE__) . '/url.php');
class Tasks{
    public static $_tasks_config = array(
        "v2" => array(
            "data_schema"=> array(
                "pan_ocr"=> array("mandate_fields"=> array("doc_url"), "optional_fields"=> array(), "any"=> array()),
                "pan_verification"=> array("mandate_fields"=> array("pan_number", "pan_name"),
                                     "optional_fields"=> array(), "any"=> array()),
                "aadhaar_ocr"=> array("mandate_fields"=> array("doc_url", "aadhaar_consent"),
                                "optional_fields"=> array(), "any"=> array()),
                "cheque_ocr"=> array("mandate_fields"=> array("doc_url"), "optional_fields"=> array(), "any"=> array()),
                "voter_ocr"=> array("mandate_fields"=> array("doc_url"), "optional_fields"=> array(), "any"=> array()),
                "voter_verification"=> array("mandate_fields"=> array("voter_number", "voter_name"),
                                       "optional_fields"=> array(), "any"=> array()),
                "driving_license_ocr"=> array("mandate_fields"=> array("doc_url"),
                                        "optional_fields"=> array(), "any"=> array()),
                "driving_license_details"=> array("mandate_fields"=> array("dl_number", "date_of_birth"),
                                            "optional_fields"=> array(), "any"=> array()),
                "passport_ocr"=> array("mandate_fields"=> array("doc_url"),
                                 "optional_fields"=> array(), "any"=> array()),
                "company_details"=> array("mandate_fields"=> array(),
                                    "optional_fields"=> array(), "any"=> array("company_name", "cin")),
                "coi_ocr"=> array("mandate_fields"=> array("doc_url"),
                            "optional_fields"=> array(), "any"=> array()),
                "coi_verification"=> array("mandate_fields"=> array(),
                                     "optional_fields"=> array(), "any"=> array("company_name", "cin")),
                "domain_identification"=> array("mandate_fields"=> array("company_name"),
                                          "optional_fields"=> array(), "any"=> array()),
                "rc_verification"=> array("mandate_fields"=> array("vehicle_number"),
                                    "optional_fields"=> array(), "any"=> array()),
                "face_compare"=> array("mandate_fields"=> array("url_1", "url_2"),
                                 "optional_fields"=> array(), "any"=> array()),
                "face_validation"=> array("mandate_fields"=> array("doc_url"),
                                    "optional_fields"=> array(), "any"=> array()),
                "pan_validation"=> array("mandate_fields"=> array("doc_url"),
                                   "optional_fields"=> array(), "any"=> array()),
                "gst_ocr"=> array("mandate_fields"=> array("doc_url"), "optional_fields"=> array(), "any"=> array()),
                "gst_verification"=> array("mandate_fields"=> array("gstin"), "optional_fields"=> array(), "any"=> array()), 
                "aadhaar_verification"=>array("mandate_fields"=>array("aadhaar_number","aadhaar_name",                        "aadhaar_consent"), "optional_fields"=>array(), "any"=> array()),
                                   
            ),
            "available_tasks"=>array('pan_ocr', 'pan_verification', 'aadhaar_ocr', 'cheque_ocr', 'voter_ocr', 'voter_verification',
            'driving_license_ocr', 'driving_license_details', 'passport_ocr', 'company_details', 'coi_ocr',
            'coi_verification', 'domain_identification', 'rc_verification', 'face_compare', 'face_validation',
            'pan_validation','gst_ocr','gst_verification', 'aadhaar_verification')

            ),

        "v3"=>
            array(
                "data_schema"=> array(
                    "createAadhaarOcrTask"=> array(
                        "mandate_fields"=> array("task_id", "data"),
                        "optional_fields"=> array("group_id"), "any"=> array()
                    ),
                    "createChequeOcrTask"=> array(
                        "mandate_fields"=> array("task_id", "data"),
                        "optional_fields"=> array("group_id"), "any"=> array()
                    ),
                    "createDLOcrTask"=> array(
                        "mandate_fields"=> array("task_id", "data"),
                        "optional_fields"=> array("group_id"), "any"=> array()
                    ),
                    "createDLVerificationTask"=> array(
                        "mandate_fields"=> array("task_id", "data"),
                        "optional_fields"=> array("group_id"), "any"=> array()
                    ),
                    "createFaceCompareTask"=> array(
                        "mandate_fields"=> array("task_id", "data"),
                        "optional_fields"=> array("group_id"), "any"=> array()
                    ),
                    "createFaceValidationTask"=> array(
                        "mandate_fields"=> array("task_id", "data"),
                        "optional_fields"=> array("group_id"), "any"=> array()
                    ),
                    "createPanOcrTask"=> array(
                        "mandate_fields"=> array("task_id", "data"),
                        "optional_fields"=> array("group_id"), "any"=> array()
                    ),
                    "createPanVerificationTask"=> array(
                        "mandate_fields"=> array("task_id", "data"),
                        "optional_fields"=> array("group_id"), "any"=> array()
                    ),
                    "createPanValidationTask"=> array(
                        "mandate_fields"=> array("task_id", "data"),
                        "optional_fields"=> array("group_id"), "any"=> array()
                    ),
                    "createVoterOcrTask"=> array(
                        "mandate_fields"=> array("task_id", "data"),
                        "optional_fields"=> array("group_id"), "any"=> array()
                    ),
                    "createVoterVerificationTask"=> array(
                        "mandate_fields"=> array("task_id", "data"),
                        "optional_fields"=> array("group_id"), "any"=> array()
                    ),
                    "createPassportOcrTask"=> array(
                        "mandate_fields"=> array("task_id", "data"),
                        "optional_fields"=> array("group_id"), "any"=> array()
                    ),
                    "createNameCompareTask"=> array(
                        "mandate_fields"=> array("task_id", "data"),
                        "optional_fields"=> array("group_id"), "any"=> array()
                    ),
                    "aadhaarOcrResult"=> array("mandate_fields"=> array("request_id"), "optional_fields"=> array(),
                                         "available_output_fields"=> array(
                                             "status", "request_id", "task_id",
                                             "group_id", "aadhaar_number",
                                             "name_on_card", "gender",
                                             "year_of_birth", "address",
                                             "date_of_birth", "district", "error",
                                             "message", "pincode", "state",
                                             "street_address", "is_scanned", "raw_text",
                                         )),
                    "chequeOcrResult"=> array("mandate_fields"=> array("request_id"), "optional_fields"=> array(),
                                        "available_output_fields"=>array (
                                            "status", "request_id", "task_id",
                                            "group_id", "account_name", "account_no",
                                            "account_type", "bank_address",
                                            "bank_name", "ifsc_code", "error",
                                            "message", "raw_text",
                                        )),
                    "dlOcrResult"=> array("mandate_fields"=> array("request_id"), "optional_fields"=> array(),
                                    "available_output_fields"=> array(
                                        "status", "request_id", "task_id",
                                        "group_id", "error", "message", "address",
                                        "date_of_birth", "date_of_validity",
                                        "dl_number", "name_on_card",
                                        "fathers_name",
                                        "raw_text",
                                    )),
                    "dlVerificationResult"=> array("mandate_fields"=> array("request_id"),
                                             "optional_fields"=> array(),
                                             "available_output_fields"=> array(
                                                 "status", "request_id", "task_id",
                                                 "group_id", "error", "message",
                                                 "cov_details",
                                                 "badge_details", "date_of_issue",
                                                 "dl_number", "dob", "dl_status",
                                                 "id_status", "last_transacted_at",
                                                 "non_transport_valid_from",
                                                 "non_transport_valid_to", "transport_valid_from",
                                                 "transport_valid_to",
                                                 "retry_count", "next_try_at", "raw_text",
                                             )),
                    "faceCompareResult"=> array("mandate_fields"=> array("request_id"), "optional_fields"=> array(),
                                          "available_output_fields"=> array(
                                              "status", "request_id", "task_id",
                                              "group_id", "error", "face_1",
                                              "face_2", "match_band", "match_score", "message",
                                          )),
                    "faceValidationResult"=> array("mandate_fields"=> array("request_id"),
                                             "optional_fields"=> array(),
                                             "available_output_fields"=> array(
                                                 "status", "request_id", "task_id",
                                                 "group_id", "error", "message",
                                                 "liveness",
                                             )),
                    "panOcrResult"=> array("mandate_fields"=> array("request_id"), "optional_fields"=> array(),
                                     "available_output_fields"=>array (
                                         "status", "request_id", "task_id",
                                         "group_id", "error", "message",
                                         "date_of_issue",
                                         "date_on_card", "fathers_name", "is_scanned",
                                         "minor", "name_on_card",
                                         "pan_number", "pan_type",
                                         "raw_text",
                                     )),
                    "panVerificationResult"=> array("mandate_fields"=> array("request_id"),
                                              "optional_fields"=> array(),
                                              "available_output_fields"=> array(
                                                  "status", "request_id", "task_id",
                                                  "group_id", "error", "message",
                                                  "id_status", "first_name",
                                                  "middle_name", "last_name", "gender",
                                                  "name_match_result", "pan_name",
                                                  "pan_number", "type",
                                              )),
                    "panValidationResult"=> array("mandate_fields"=> array("request_id"), "optional_fields"=> array(),
                                            "available_output_fields"=> array(
                                                "tampering_detection", "basic_validation",
                                                "request_id", "task_id",
                                                "group_id", "error", "message", "status",
                                            )),
                    "voterOcrResult"=> array("mandate_fields"=> array("request_id"), "optional_fields"=> array(),
                                       "available_output_fields"=> array(
                                           "status", "request_id", "task_id",
                                           "group_id", "error", "message",
                                           "name_on_card",
                                           "date_on_card", "voter_number",
                                           "fathers_name", "raw_text",
                                       )),
                    "voterVerificationResult"=> array("mandate_fields"=> array("request_id"),
                                                "optional_fields"=> array(),
                                                "available_output_fields"=> array(
                                                    "request_id", "task_id", "group_id",
                                                    "id_status", "error",
                                                    "rln_number", "message", "type",
                                                    "name", "voter_number", "ac_name", "ac_no",
                                                    "gender", "district",
                                                    "house_no", "part_no",
                                                    "ps_lat_long", "ps_name", "section_no",
                                                    "st_code", "state",
                                                    "match_result", "last_update",
                                                )),
                    "passportOcrResult"=> array("mandate_fields"=> array("request_id"), "optional_fields"=> array(),
                                          "available_output_fields"=> array(
                                              "date_of_birth", "date_of_expiry", "date_of_issue",
                                              "error", "given_name", "group_id",
                                              "message", "passport_number", "place_of_issue",
                                              "raw_text", "request_id",
                                              "status", "surname", "task_id",
                                          )),
                    "nameCompareResult"=> array("mandate_fields"=> array("request_id"), "optional_fields"=> array(),
                                          "available_output_fields"=>array (
                                              "request_id", "status", "task_id",
                                              "group_id", "name_compare_response",
                                          )),
                ),
                "available_tasks"=>array (
                    "createAadhaarOcrTask", "createChequeOcrTask", "createDLOcrTask",
                    "createFaceCompareTask", "createFaceValidationTask", "createPanOcrTask",
                    "createPanVerificationTask", "createPanValidationTask",
                    "createVoterOcrTask", "createVoterVerificationTask", "createDLVerificationTask",
                    "createPassportOcrTask", "createNameCompareTask", "aadhaarOcrResult",
                    "chequeOcrResult", "dlOcrResult",
                    "dlVerificationResult", "faceCompareResult", "faceValidationResult",
                    "panOcrResult", "panVerificationResult",
                    "panValidationResult", "voterOcrResult", "voterVerificationResult",
                    "passportOcrResult", "nameCompareResult"),
            )
    );

}
?>