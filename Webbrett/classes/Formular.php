
<?php

class Formular{
    private $number;
    private $submit;
    private $formList;

    public function __construct ($number = 0, $submit = "send", $formList = NULL){
        $this->number = $number;
        $this->submit = $submit;
    }

    public function getNumber(){
        return $this->submit;
    }

    public function setNumber($number){
        $this->submit = $number;
    }

    public function getSubmit(){
        return $this->submit;
    }

    public function setSubmit($submit){
        $this->submit = $submit;
    }

    public function setFormList(FormType $form){
        $this->formList[] = $form;
    }


    public function getFormList(){
        return $this->formList;
    }




    public function createForm(){ ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> <?php
            foreach($this->formList as $form){
                $form->createFormInput();
            } ?>
            <div>
                <input type="submit" value="<?php echo $this->submit ?>">
            </div>
        </form> <?php 
    }
}


?>