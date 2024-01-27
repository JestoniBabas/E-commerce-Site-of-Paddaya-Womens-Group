
//settings  portion starts here

// document.getElementById("in_date").valueAsDate = new Date();

function show_menu(){
    
    const nav = document.querySelector('#nav');

    nav.classList.toggle('show_nav');
}
//---add room type
const addRoomTypeForm = document.querySelector('#addRoomTypeForm');

addRoomTypeForm.addEventListener('submit', (e) => {
    
    e.preventDefault();

    const addRoomTypeLoader = document.querySelector('#addRoomTypeLoader');
    const addRoomType = document.querySelector('#addRoomType').value;

    addRoomTypeLoader.innerHTML='<img src="gifs/rot.gif" class="rot" loading="lazy" /> Processing...';

    const data = new FormData();

    data.append('addRoomType', addRoomType);

    fetch('ajax/addRoomType.php', {
        method: "POST",
        body: data
    })
    .then(response => response.text())
    .then(res => {
       addRoomTypeLoader.innerHTML=res;
       document.querySelector('#addRoomType').value="";
    })

});
//-----


//add room
const roomSet = document.querySelector('#roomSet');
roomSet.addEventListener('submit', function(e){
    
    e.preventDefault();

    const setRoomLoader = document.querySelector('#setRoomLoader');
    const room_type = document.querySelector('#room_type').value;
    const room_no = document.querySelector('#room_no').value;
    const room_price = document.querySelector('#room_price').value;
    const room_status = document.querySelector('#room_status').value;

    setRoomLoader.innerHTML='<img src="gifs/rot.gif" class="rot" loading="lazy" /> Processing...';

    const data = new FormData();

    data.append('room_type', room_type);
    data.append('room_no', room_no);
    data.append('room_price', room_price);
    data.append('room_status', room_status);

    fetch('ajax/addRoom.php', {
        method: "POST",
        body: data
    })
    .then(response => response.text())
    .then(res => {
        setRoomLoader.innerHTML=res;
       document.querySelector('#room_type').value="";
       document.querySelector('#room_no').value="";
       document.querySelector('#room_price').value="";
       document.querySelector('#room_status').value="vacant ready";
    })

});




//-----

function close_inner(){
    const inner = document.querySelector('.inner');
const outer = document.querySelector('.outer');
    outer.innerHTML="";
    fadeOut(inner);
}

//--- 

function update_room_status(e){

    const room_id = e;
    const inp = document.querySelector('#room_id'+room_id).value;

    const inner = document.querySelector('.inner');
    const outer = document.querySelector('.outer');

    const rm_reloader = document.querySelector('#rm_reloader');


    outer.innerHTML='<center><img src="gifs/rot2.gif" class="rot2" alt="loading" loading="lazy"/></center>';
    

    const data = new FormData();

    data.append('room_id', room_id);
    data.append('room_status', inp);

    

    fadeIn(inner);

    fetch('ajax/update_room_status.php', {
        method: 'POST',
        body: data
    })
    .then(response => response.text())
    .then(res => {
        
        if(res < 1){
            outer.innerHTML='<h3 class="text-center text-success"><span class="glyphicon glyphicon-ok"></span> Save success!</h3>';
            fetch('ajax/reload_room_info.php')
            .then(response => response.text())
            .then(result => {
                rm_reloader.innerHTML=result;
            })
     
        } else {
            outer.innerHTML='<h2 class="text-center text-danger"><p class="glyphicon glyphicon-remove"></span> Something went wrong! Please refresh your browser</p>';
        }
        
       
    })

    setInterval(() => {
        fadeOut(inner);
    }, 3000);

}

function room_cuztomize(e){
    
    const id = e;

    const inner = document.querySelector('.inner');
    const outer = document.querySelector('.outer');


    outer.innerHTML='<center><img src="gifs/rot2.gif" class="rot2" alt="loading" loading="lazy"/></center>';
    
    fadeIn(inner);

    const data = new FormData();

    data.append('id', id);

    fetch('ajax/customize_room.php', {
        method: 'POST',
        body: data
    })
    .then(response => response.text())
    .then(res => {
        outer.innerHTML=res;
    })


}

function room_type_edit(e){
    const id = e;
    const old_rt = document.querySelector('#old_rt').value;
    const room_type = document.querySelector('#room_type_1').value;
    const responser = document.querySelector('#responser_customize_room');

    responser.innerHTML='<img src="gifs/rot.gif" class="rot"/> Saving...';

    const data = new FormData();

    data.append('id', id);
    data.append('old_rt', old_rt);
    data.append('room_type', room_type);

    fetch('ajax/change_roomtype.php', {
        method: 'POST',
        body: data
    })
    .then(response => response.text())
    .then(res => {
        responser.innerHTML=res;
    })


    
}


function edit_room(e){

    const room_no = document.querySelector('#room_no'+e).value;
    const room_price = document.querySelector('#room_price'+e).value;
    const old_room_no = document.querySelector('#old_room_no'+e).value;
    const old_room_price = document.querySelector('#old_room_price'+e).value;


    const responser = document.querySelector('#responser_customize_room');

    responser.innerHTML='<img src="gifs/rot.gif" class="rot"/> Saving...';

    const data = new FormData();

    data.append('room_id', e);
    data.append('room_no', room_no);
    data.append('room_price', room_price);
    data.append('old_room_no', old_room_no);
    data.append('old_room_price', old_room_price);

    fetch('ajax/edit_room.php', {
        method: 'POST',
        body: data
    })
    .then(response => response.text())
    .then(res => {
        responser.innerHTML=res;
    })


    
}

// END SETTINGS ---

//this portion is the check in form

function checkIn_roomType(){

    const inner = document.querySelector('.inner');
    const outer = document.querySelector('.outer');

    var select = document.querySelector("#room_type");
    var optVal = select.options[select.selectedIndex].value;

    fadeIn(inner);

    outer.innerHTML='<center><img src="gifs/rot2.gif" class="rot2"/></center>';

    const data = new FormData();

    data.append('room_type', optVal);

    fetch('ajax/in_get_rooms.php', {
        method: 'POST',
        body: data
    })
    .then(response => response.text())
    .then(res => {
        if(res < 1){
            document.querySelector('#room_no').innerHTML="";
            document.querySelector('#room_price').innerHTML="";
            document.querySelector('#inp_room_no').value="0";
            document.querySelector('#inp_room_price').value="0";
            outer.innerHTML='<h3 class="text-center">No rooms available to '+optVal+'</h3>';
        } else {
            outer.innerHTML=res;
        }
       
    })
}

function put_room_no(a, b){

    document.querySelector('#room_no').innerHTML=a;

    const x = new Intl.NumberFormat('en-US');
    const room_price_total = x.format(b);

    document.querySelector('#room_price').innerHTML=room_price_total;

    
    document.querySelector('#inp_room_no').value=a;
    document.querySelector('#inp_room_price').value=b;

    const inner = document.querySelector('.inner');
    const outer = document.querySelector('.outer');

    outer.innerHTML="";
    fadeOut(inner);
}

function calculate_staying(){

    var out_date = document.querySelector("#out_date").value;
    var inp_room_price = document.querySelector("#inp_room_price").value;

    const num_stay = document.querySelector('#num_stay');

    const data = new FormData();

    data.append('out_date', out_date);

    fetch('ajax/calc_of_stay.php', {
        method: 'POST',
        body: data
    })
    .then(response => response.text())
    .then(res => {

        num_stay.innerHTML=res;

        const to_pay = inp_room_price * res;
        
        const x = new Intl.NumberFormat('en-US');
        const to_pay_total = x.format(to_pay);

        document.querySelector("#inp_num_stay").value=res;
        document.querySelector("#to_pay").innerHTML=to_pay_total;
        document.querySelector("#inp_to_pay").value=to_pay;
    })
}

//end check in form

//DASHBOARD 

function view_vacant_ready(){

    const inner = document.querySelector('.inner');
    const outer = document.querySelector('.outer');

    var select = document.querySelector("#vacant_ready");
    var optVal = select.options[select.selectedIndex].value;

    if(optVal != ""){

        fadeIn(inner);

        outer.innerHTML='<center><img src="gifs/rot2.gif" class="rot2"/></center>';

        const data = new FormData();

        data.append('room_id', optVal);

        fetch('ajax/view_vacant_room.php', {
            method: 'POST',
            body: data
        })
        .then(response => response.text())
        .then(res => {
            outer.innerHTML=res;
        })

    }
}



function view_occupied(){
    const inner = document.querySelector('.inner');
    const outer = document.querySelector('.outer');

    var select = document.querySelector("#occupied");
    var optVal = select.options[select.selectedIndex].value;

    if(optVal != ""){

        fadeIn(inner);

        outer.innerHTML='<center><img src="gifs/rot2.gif" class="rot2"/></center>';

        const data = new FormData();

        data.append('room_ref', optVal);

        fetch('ajax/view_occupied_room.php', {
            method: 'POST',
            body: data
        })
        .then(response => response.text())
        .then(res => {
            outer.innerHTML=res;
        })
    }
}

function to_pay_inp_out(){

    const out_amount_paid = document.querySelector('#out_amount_paid').value;
    const bal = document.querySelector('#to_pay').value;
    const amount_given = document.querySelector('#amount_given').value;
    const btn_checkout = document.querySelector('#btn_checkout');

    if(out_amount_paid != ""){
        if(Number(out_amount_paid) > Number(bal) ){
            fadeOut(btn_checkout);
        } else {
            fadeIn(btn_checkout);
        }
    } else {
        fadeIn(btn_checkout);
    }


}
function btn_checkout(){

    const data = new FormData();

    const out_amount_paid = document.querySelector('#out_amount_paid').value;
    const in_id = document.querySelector('#in_id').value;

    const inner = document.querySelector('.inner');
    const outer = document.querySelector('.outer');
    const dashboard_reloader = document.querySelector('#dashboard_reloader');

    
    if(out_amount_paid == ""){
        document.querySelector('#out_amount_paid').focus();
    } else {
        
        outer.innerHTML='<center><img src="gifs/rot2.gif" class="rot2"/></center>';
        
        data.append('in_id', in_id);
        data.append('out_amount_paid', out_amount_paid);

        fetch('ajax/check_out_process.php', {
            method: 'POST',
            body: data
        })
        .then(response => response.text())
        .then(res => {
            if(res == 0){
                outer.innerHTML='<h1 class="text-center text-success"><span class="glyphicon glyphicon-ok"></span> Check-out success!</h1>';
                fetch('ajax/reload_dashboard.php')
                .then(response => response.text())
                .then(result => {
                    dashboard_reloader.innerHTML=result;
                })
            } else {
                outer.innerHTML='<h1 class="text-center text-danger"><span class="glyphicon glyphicon-exclamation-sign"></span> Something went wrong! Refresh your browser</h1>';
            }
        })
    }
}


//end dashboard


function view_soon_checkout(){
    
    const inner = document.querySelector('.inner');
    const outer = document.querySelector('.outer');

    outer.innerHTML='<center><img src="gifs/rot2.gif" class="rot2"/></center>';

    fadeIn(inner);

    fetch('ajax/soon_checkout_list.php')
    .then(response => response.text())
    .then(res => {
        outer.innerHTML=res;
    })

}

function reset_user(e){
	
	const inner = document.querySelector('.inner');
    const outer = document.querySelector('.outer');

    outer.innerHTML='<center><img src="gifs/rot2.gif" class="rot2"/></center>';

    fadeIn(inner);
	
	const data = new FormData();
	
	data.append('uid', e);
	
    fetch('ajax/reset_user.php', {
		method: 'POST',
		body: data
	})
    .then(response => response.text())
    .then(res => {
        outer.innerHTML=res;
    })
	
}




