$(function () {

    const btnr = document.querySelector('.btnr');
    var rating = 0; 

    $(".rateyo-readonly-widg").rateYo({

        rating: 0,
        numStars: 5,
        precision: 2,
        minValue: 1,
        maxValue: 5
        }).on("rateyo.change", function (e, data) {

            rating=data.rating;
        // console.log(data.rating);
        $(this).parent().find('.result').text('rating:' + data.rating);
        
        $(this).parent().find('input[name=rating]').val(data.rating);
        document.getElementById("v_rating").value = rating;

            if(data.rating > 0){
                document.getElementById("btn-rating").disabled = false;
                btnr.classList.add('active');
            }else{
                document.getElementById("btn-rating").disabled = true;
                btnr.classList.remove('active');
            }
        });


 });