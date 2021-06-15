jQuery(document).ready(function () {

    jQuery('.tab').on('click', function (e) {
        jQuery('.tab').removeClass('active-tab');
        jQuery(this).addClass('active-tab');
        let data_tab = jQuery(this).attr('data-tab');
        jQuery('.tab-c').removeClass('show');
        console.log(data_tab);
        jQuery('.' + data_tab).addClass('show');
    })



    //add food
    jQuery('#addNewFoodItemBtn').on('click', function () {
        let foodVal = $('#newFoodName').val()
        jQuery.ajax({
            url: "addItem.php",
            data: {
                food: foodVal
            },
            dataType: 'json',
            type: "POST",
            success: function (result) {
                console.log(result)
                if (result.error === false) {

                    $('.userAddMessage').html(result.message);
                    $('.userAddMessage').addClass('alert alert-success')
                    var table = $('#mainTable').DataTable();
                    table.clear().rows.add(result.data).draw();
                } else {
                    $('.userAddMessage').innerHTML = result.message
                    $('.userAddMessage').addClass('alert alert-danger')
                }
            }
        });


    })

    //delete food

    jQuery(document).on('click', '.deleteItem', function () {
        if (window.confirm('Are you sure you want to delete this item?') === true) {
            let itemId = jQuery(this).attr('data-id');

            jQuery.ajax({
                url: "removeItem.php",
                data: {
                    id: itemId
                },
                dataType: 'json',
                type: "POST",
                success: function (result) {
                    console.log(result)
                    if (result.error === false) {
                        console.log(result);
                        var table = $('#mainTable').DataTable();
                        table.clear().rows.add(result.data).draw();
                    } else {

                    }
                }
            });
        }

    })


    //edit item 
    jQuery(document).on('click', '.editItem', function () {

        let itemId = jQuery(this).attr('data-id');

        jQuery.ajax({
            url: "editItem.php",
            data: {
                id: itemId
            },
            dataType: 'json',
            type: "POST",
            success: function (result) {

                if (result.error === false) {
                    console.log(result);
                    $(result.data).appendTo('body').modal();


                }
            }
        });


    })

    //update item

    jQuery(document).on('click', '#editFoodItem', function () {

        let itemId = jQuery(this).attr('data-id');
        let newFoodName = document.getElementById('editedFoodName' + itemId).value;

        console.log(itemId, newFoodName)

        jQuery.ajax({
            url: "updateitem.php",
            data: {
                id: itemId,
                food: newFoodName
            },
            dataType: 'json',
            type: "POST",
            success: function (result) {

                if (result.error === false) {
                    console.log(result)
                    $('.userAddMessage').html(result.message)
                    $('.userAddMessage').addClass('alert alert-success mt-3')

                    var table = $('#tableLogs').DataTable();
                    table.clear().rows.add(result.data).draw();

                    var table = $('#mainTable').DataTable();
                    table.clear().rows.add(result.food).draw();

                }
            }
        });


    })

    //view item 
    jQuery(document).on('click', '.viewItem', function () {


        let itemId = jQuery(this).attr('data-id');

        jQuery.ajax({
            url: "view.php",
            data: {
                id: itemId
            },
            dataType: 'json',
            type: "POST",
            success: function (result) {

                if (result.error === false) {
                    console.log(result);
                    $(result.data).appendTo('body').modal();


                }
            }
        });


    })


    jQuery('#tableLogs').DataTable({
        ajax: 'logs.php',
        dataSrc: 'data'


    });

    jQuery('#mainTable').DataTable({
        ajax: 'allFood.php',
        dataSrc: 'data',
        responsive: true,
        columns: [{
                data: 'id'
            },
            {
                data: 'foodName'
            },
            {
                data: 'actions'
            },
        ]



    });


    jQuery.ajax({
        url: "./allFood.php",
        dataType: 'json',
        type: "GET",
        success: function (result) {
            console.log(result);

        }
    });



})