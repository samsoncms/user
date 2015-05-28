/**
 * Created by egorov on 11.04.2015.
 */

// Init when in user module
s('#user').pageInit(function(parent) {

    // Creater generic loader instance
    var loader = new Loader();

    // Content container
    var container = s('#content', parent);

    /**
     * Initialize user form
     * @param clickable Element to click fot form showing
     */
    var initForm = function(clickable) {
        clickable.tinyboxAjax({
            html: 'html',
            oneclickclose:true,
            renderedHandler: function (response, tb) {
                s(".form2").ajaxSubmit(function(response) {
                    tb.close();
                    initList(response);
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
        if (response && response.collection_html) {
            container.html(response.collection_html);
        }

        // Bind form list elements
        initForm(s('.template-list-btn-edit', container));

        /*// Bind delete action
        s('.delete', container).ajaxClick(initList, function(clicked) {
            return confirm(clicked.a('title'));
        });*/
    };

    // Bind form from sub-menu button
    initForm(s('.template-list-btn-form'));

    // Init interface
    initList();
});