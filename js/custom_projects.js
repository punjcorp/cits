// external js: isotope.pkgd.js, imagesloaded.pkgd.js

// init Isotope
var $grid = $('.projects').isotope({
  itemSelector: '.project-item',
  percentPosition: true,
  masonry: {
    columnWidth: '.project-sizer'
  }
});
// layout Isotope after each image loads
$grid.imagesLoaded().progress( function() {
  $grid.isotope('layout');
});





$(function() {

  $('input:radio[name=filterSelect]').change(function(){
    var selectedFilter=$('input[name=filterSelect]:checked').val();
    $grid.isotope({ filter: '.'+selectedFilter });
  });


});


