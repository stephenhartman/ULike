$(document).ready(function () {
    $("#rateYo").rateYo({
      starWidth: "40px",
      spacing   : "5px",
      multiColor: {

        "startColor": "#279b4f", //DARK GREEN
        "endColor"  : "#5DC327"  //LIGHT GREEN
      },
      rating: 4.5,
      halfStar: true,
      precision: 1
    });
  });
