<?php
 include_once dirname(__FILE__) .'/../utils/model_convertor.php';
 include_once dirname(__FILE__) .'/../models/message.php';
 include_once dirname(__FILE__) .'/../accessors/academic_year_accessor.php';

class Academic_Year_Controller {
    public function __construct()
    {
        $this->academic_year_accessor = new Academic_Year_Accessor();
    }
    public function add_academic_year($body){
        $json_obj=json_decode($body);
        if(!$json_obj->year || !$json_obj->description){
            return new App_Message(false, "All values are required");
        }

        $res = Model_Convertor::to_academic_year_model($body);
        return $this->academic_year_accessor->add_academic_year ($res);
    }

    public function edit_academic_year($body){
        $json_obj=json_decode($body);
        if(!$json_obj->year || !$json_obj->description){
            return new App_Message(false, "All values are required");
        }

        $res = Model_Convertor::to_academic_year_model($body);
        return $this->academic_year_accessor->edit_academic_year($res);
    }

    public function delete_academic_year($id){
        return $this->academic_year_accessor->delete_academic_year($id);
    }

    public function get_academic_year($id){
        $res=[];
        if(!isset($id)){
            $res = new App_error(400, "Invalid academic year id");
            return $res;
        }
        $res= $this->academic_year_accessor->get_academic_year($id);
        return Model_Convertor::to_academic_year_model(json_encode($res));

    }

    public function get_academic_years(){
        $res = [];
        $academic_years=$this->academic_year_accessor->get_academic_years();
        foreach($academic_years as $academic_year){
            $res[] = Model_Convertor::to_academic_year_model(json_encode($academic_year));
        }
        return $res;
    }
}
?>