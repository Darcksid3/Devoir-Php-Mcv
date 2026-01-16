$(document).ready(function(){
        $('#myModal').on('show.bs.modal', function (e) {
            var rowid = $(e.relatedTarget).data('id');
            $.ajax({
                type : 'post',
                url : '/Modale/' + rowid, //Here you will fetch records 
                success : function(data){
                $('.fetched-data').html(data);//Show fetched data from database
                }
            });
        });
    });