$(document).ready(function () {
    console.log("home load");
    fetchHomeContent();
    // var home_content = false;
    
    // $(document).on('click','#nav_home', function() {
    //   if (!home_content) {
    //     home_content = true;
    //     fetchHomeContent();
    //   }
    // });

    function fetchHomeContent(){
        var url = base_url + "fetch-home-content";
        
        $.ajax({
            url: url,
            type: "POST",
            data: {
                valid:1
            },
            dataType: "json",
            success: function (response) {

               $('#home_content_feed').html(response);
                
            },
        });
    }
})