// Graph
var ctx = document.getElementById("myChart");



$(document).on('click','.nav-action',function(){
  var dashboard = $(this).data('nav');
  $('.nav-action').removeClass('active');
  $(this).addClass('active');
  console.log('hello');
  $('.dashboard-content').hide();
  $('#dashboard-' + dashboard).show();
})

$(document).ready(function () {
  $('#usertable').dataTable();
  $('#event_table_list').dataTable();

  $(document).on('click', '.edit-user', function () {
    console.log('hello');
      var data = $(this).data('user');
     
      data = atob(data);
      data = JSON.parse(data);
      $('#EditUser').modal('show');
  })


  $(document).on('click','.reset-password',function(){
    var username = $(this).data('username');
    var systemid = $(this).data('sysid');
    if(username != '' && systemid != ''){
      $('#resetPassword').modal('show');
    }
    console.log(username,systemid);
  })
})
