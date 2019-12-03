    $(function() {
        var url = window.location;
        var element = $('ul#accordionSidebar a').filter(function() {
            return this.href == url;
        }).addClass('active').parent().addClass('active');
        while (true) {
            if (element.is('div')) {
                element = element.parent().addClass('show').parent().addClass('active');
            } else {
                break;
            }
        }
    });