/**
 * Created by egorov on 11.04.2015.
 */

// Init when in user module
s('#user').pageInit(function(parent){

    // Creater generic loader instance
    var loader = new Loader(s('body'));

    // Content container
    var container = s('#container', parent);

    /**
     * Initialize user form
     * @param clickable Element to click fot form showing
     */
    var initForm = function(clickable) {
        clickable.tinyboxAjax({
            html: 'html',
            renderedHandler: function (response, tb) {
                s(".form2").ajaxSubmit(function (response) {
                    loader.hide();
                    tb._close();
                    initList(response);
                }, function () {
                    loader.show(true);
                    return true;
                });
            },
            beforeHandler: function () {
                loader.show('Загрузка формы', true);
                return true;
            },
            responseHandler: function () {
                loader.hide();
                return true;
            }
        });
    };

    /**
     * User module UI initialization and events
     * @param response Server response for rendering
     */
    var initList = function(response)
    {
        // Render server response
        if (response && response.list_html) {
            container.html(response.list_html);
        }

        // Bind form list elements
        initForm(s('.edit', container));

        // Bind delete action
        s('.delete', container).ajaxClick(initList, function(clicked) {
            return confirm(clicked.a('title'));
        });
    };

    // Bind form from sub-menu button
    //initForm(s('#createNewUser'));

    // Init interface
    //initList();
});