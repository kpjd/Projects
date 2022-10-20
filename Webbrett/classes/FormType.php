
<?php

class FormType{
    private $name;
    private $bezeichnung;
    private $type;
    private $minOrRows;
    private $maxOrCols;
    private $rubrikList;
    private $value;

    public function __construct ($name = "default", $bezeichnung = "test", $type = "text",
                                    $value = "foobar", Rubrik $rubrikList = NULL, $minOrRows = NULL,
                                    $maxOrCols = NULL){
        $this->name = $name;
        $this->bezeichnung = $bezeichnung;
        $this->type = $type;
        $this->value = $value;
        $this->rubrikList = $rubrikList;
        $this->minOrRows = $minOrRows;
        $this->maxOrCols = $maxOrCols;
    }

    public function getName(){
        return $this->name;
    }

    public function setName($name){
        $this->name = $name;
    }

    public function getBezeichnung(){
        return $this->bezeichnung;
    }

    public function setBezeichnung($bezeichnung){
        $this->bezeichnung = $bezeichnung;
    }

    public function getType(){
        return $this->type;
    }

    public function setType($type){
        $this->type = $type;
    }

    public function getMinOrRows(){
        return $this->minOrRows;
    }

    public function setMinOrRows($mini){
        $this->minOrRows = $mini;
    }

    public function getMaxOrCols(){
        return $this->maxOrCols;
    }

    public function setMaxOrCols($maxi){
        $this->maxOrCols = $maxi;
    }

    public function getRubrikList(){
        return $this->rubrikList;
    }

    public function setRubrikList(Rubrik $options){
        $this->rubrikList[] = $options;
    }

    public function getValue(){
        return $this->value;
    }

    public function setValue($value){
        $this->value = $value;
    }


    public function createFormInput(){
        switch($this->type){
            case "text": ?>
                    <label for="<?php echo $this->name; ?>"> <?php echo $this->bezeichnung ?>: </label>
                    <div>
                    <input type="<?php echo $this->type; ?>"
                            id="<?php echo $this->name; ?>"
                            name="<?php echo $this->name; ?>"
                            value="<?php echo $this->value; ?>">
                    </div> <?php
                break;
            
            case "number": ?>
                <div>
                    <label for="<?php echo $this->name; ?>"> <?php echo $this->bezeichnung ?>: </label>
                        <input type="<?php echo $this->type; ?>"
                            id="<?php echo $this->name; ?>"
                            name="<?php echo $this->name; ?>"
                            value="<?php echo $this->value; ?>"
                            min="<?php echo $this->minOrRows; ?>"
                            max="<?php echo $this->maxOrCols; ?>"
                            >
                </div> <?php
                break;

            case "checkbox": ?>
                <label for="<?php echo $this->name; ?>"> <?php
                    echo $this->bezeichnung ?>:
                </label> <?php
                foreach($this->rubrikList as $rubrik){ ?>
                    <div>
                        <input type ="<?php echo $this->type ?>"
                                id="<?php echo $rubrik->getBezeichnung() ?>"
                                name="<?php echo $this->name?>[]"
                                value="<?php echo $rubrik->getBezeichnung() ?>"
                                >
                        <label for="<?php echo $rubrik->getBezeichnung() ?>"> <?php echo $rubrik->getBezeichnung() ?> </label><br>
                    </div> <?php
                }
                break;
            
            case "textarea": ?>
                <div>
                    <label for="<?php echo $this->name; ?>"> <?php echo $this->bezeichnung ?>: </label>
                    <textarea
                        rows="<?php echo $this->minOrRows; ?>"
                        cols="<?php echo $this->maxOrCols; ?>"
                        name="<?php echo $this->name; ?>"
                        id="<?php echo $this->name; ?>"
                        > <?php echo $this->value; ?>
                    </textarea>
                </div> <?php
                break;

            default:
                echo "Error: formtype \"" . $this->type . "\" not supported!";
                break;
        }
    }
}


?>