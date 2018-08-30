<?php
class NotesNorm extends Notes{
    public function display(){
        $style = "<div style='background-color:PaleGreen;border: 1px solid black; display: inline; margin: 2px;' class='col-xs-3' id='note_num-" . $this->page_num . "'>";
        $style .= "<h4>NOTE</h4>"; 
        $style .= parent::display();
        $style .= "</div></div>"; 
        return $style;
    }
}

?>