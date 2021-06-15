jQuery(document).ready(function () {

    jQuery('.tab').on('click', function (e) {
        jQuery('.tab').removeClass('active-tab');
        jQuery(this).addClass('active-tab');
        let data_tab = jQuery(this).attr('data-tab');
        jQuery('.tab-c').removeClass('show');
        console.log(data_tab);
        jQuery('.' + data_tab).addClass('show');
    })

    //data table 
    $('#mainTable').DataTable();

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
                } else {
                    $('.userAddMessage').innerHTML = result.message
                    $('.userAddMessage').addClass('alert alert-danger')
                }
            }
        });


    })

    //delete food

    jQuery('.deleteItem').on('click', function () {
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
                    } else {

                    }
                }
            });
        }

    })


    //edit item 
    jQuery('.editItem').on('click', function () {

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
        let newFoodName = jQuery('#editedFoodName').val()

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
                    $('.userAddMessage').html(result.message)
                    $('.userAddMessage').addClass('alert alert-success mt-3')

                }
            }
        });


    })

    //view item 
    jQuery('.viewItem').on('click', function () {


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

    jQuery.ajax({
        url: "./logs.php",
        dataType: 'json',
        type: "GET",
        success: function (result) {
            console.log(result);

        }
    });



})