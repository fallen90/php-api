<?php
final class Utils {
    private function __construct(){}
    public function organize_file_fields($files){
        $attachments = [];
        foreach($files as $key_field=>$field){
            foreach($field as $key=>$value){
                $attachments[$key][$key_field] = $value;
            }
        }
        return $attachments;
    }
}