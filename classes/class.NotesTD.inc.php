<?php
class NotesTD extends Notes{
    public function display(){
        $style = "<div style='background-color:Yellow;border: 1px solid black; display: inline-block; margin: 2px;' class='col-xs-3' id='note_num-" . $this->page_num . "'>";
        
        $style .= "<h4>TO-DO</h4>"; 
        $style .= parent::display();
        $style .= "</div>"; 
        return $style;
    }
}

?>