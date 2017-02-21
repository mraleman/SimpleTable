    /**
        Using closure to save all the AJAX Requests
    */
    USERS={
        init:function () {
            //Add listeners to each button
            $( document ).on('click', 'button',function(event){
                $(this).prop("disabled",true);
                var val = $(this).attr('id');
                var str = {method:'update',id:val};
                USERS.loadAjax(str,USERS.updateUser);
            });
        },
        /**
            Send request via AJAX call.
            Both Request and Response will be in JSON
        */
        loadAjax:function (str) {
            $.ajax({
                type: 'POST',
                url: 'app/Simpletable/Source/Ajax/Users.php',
                data: str,
                success: function(data){
                    USERS.loadData(data);
                },
                dataType: 'json',
                error: function(){
                    alert('an error occured');
                }
            });
        },
        //Takes response and loads it into the view via the DOM.
        loadData:function (data) {
            //lets check the data and check to see if there are any query errors
            console.log(data);
            if (!data['status']) {
                var errors = data['errors'];
                for(i=0;i<errors.length;i++){
                    alert(errors[i]);
                }
            } else {
                //lets handle each method seperately
                switch (data['method']) {
                    case 'init':
                        USERS.loadUsers(data['users']);
                        break;
                    case 'update':
                        USERS.updateUser(data);
                        break;
                }
            }
        },
        //Update the single usere by adding 1 to the count loading the new date
        updateUser:function(data) {
            $("#"+data['id']).prop("disabled",false);
            var cntr = $("#"+data['id']).parent().parent().children();
            var oldCount = parseInt($(cntr[2]).html());
            $(cntr[2]).html(oldCount+1);
            $(cntr[3]).html(data['modified']);
        }

    }
    $(document).ready(USERS.init());
