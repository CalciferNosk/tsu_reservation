<?php 

if( ! function_exists('_layout'))
{
    function _layout()
    {
        $CI =& get_instance();
       $html = $CI->load->view('Layouts/LoginLayout',[],true);

        return $html;
    }
}

?>