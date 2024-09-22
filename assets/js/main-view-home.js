$(document).ready(function () {
    console.log("home load");
    sessionStorage.setItem("ids",JSON.stringify(''))
    fetchHomeContent();
    // var home_content = false;
    
    // $(document).on('click','#nav_home', function() {
    //   if (!home_content) {
    //     home_content = true;
    //     fetchHomeContent();
    //   }
    // });
    $(document).on('click','#load_more', function() {
        fetchHomeContent()
    })
    function fetchHomeContent(){
        var url = base_url + "fetch-home-content";
        
        $.ajax({
            url: url,
            type: "POST",
            data: {
                valid:1,
                ids:JSON.parse(sessionStorage.getItem("ids")),
            },
            dataType: "json",
            success: function (response) {
                sessionStorage.setItem("ids",JSON.stringify(response.ids))//JSON.stringify(response.ids);
               $('#home_content_feed').append(response.html);
                
            },
        });
    }
})