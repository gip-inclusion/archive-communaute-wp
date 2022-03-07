function onSubCatTitleClickHandler() {
  jQuery(".docs-sub-cat-title, .el-betterdocs-grid-sub-cat-title").on('click', function() {
    setTimeout(function(){
      var masonryGrids = document.querySelectorAll(
        '.betterdocs-category-grid.masonry'
      );
      masonryGrids.forEach((item) => {
        var masonry = new Masonry(item);
          masonry.reloadItems()
      });
    }, 600);
  });
}

// init
jQuery(document).ready(function() {
  onSubCatTitleClickHandler();
})