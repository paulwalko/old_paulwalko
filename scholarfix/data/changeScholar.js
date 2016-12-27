$(".topnav").empty();

$(".otherSitesCategorList").first().children().each(function(index) {
        var title = $(this).children().first().attr("title");
        var id = $(this).children().last().attr("id");
        var newHTML =   "<li class='nav-menu'>\
                                <a href='https://scholar.vt.edu/portal/site/" + id + "' title='" + title + "' role='menuitem' aria-haspopup='true'>\
                                        <span>" + title + "</span>\
                                </a>\
                                <span class='drop' tabindex='-1' data='" + id + "'></span>\
                        </li>";
        $("#topnav").append(newHTML);
});
var moreSites = '<li class="more-tab">\
                  <a href="javascript:;" onclick="return dhtml_view_sites();" title="More Sites" aria-haspopup="true">\
                    <span>More Sites</span>\
                  </a>\
                </li>';
$('#topnav').append(moreSites);
