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



if( ! function_exists('_headerLayout')){

    function _headerLayout($custom_css = [],$title = 'TSU'){
        $CI =& get_instance();
        $data['custom_css'] = $custom_css;
        $data['title'] = $title;
       $html = $CI->load->view('Layouts/HeaderLayout',$data,true);

        return $html;
    }
}

if( ! function_exists('_FooterLayout')){

    function _FooterLayout($custom_js = []){
        $CI =& get_instance();
        $data['custom_js'] = $custom_js;
       $html = $CI->load->view('Layouts/FooterLayout',$data,true);

        return $html;
    }
}

?>