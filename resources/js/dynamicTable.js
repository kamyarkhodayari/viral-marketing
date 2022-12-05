$(function(){
    function addFields(el) {
        var warp = $(el);
        var target = warp.find(warp.data('af_target'));
        var addSelector = warp.data('af_add') || '.add-form-field';
        var removeSelector = warp.data('af_remove') || '.remove-form-field';
        var indicator = new RegExp(warp.data('af_indicator') || '%index%', 'g');
        var index = target.children('div, tr').length;
        var baseEl = warp.find(warp.data('af_base'));
        if (!baseEl.length) baseEl = $(warp.data('af_base'));
        if (!baseEl.length) baseEl = target.find('.form-field-base');
        var base = baseEl.html();
        baseEl.remove();
        
        warp.on('click', addSelector, function(e) {
            e.preventDefault();
            warp.find(target).append(base.replace(indicator, index));
            start();
            index++;
        });
      
        warp.on('click', removeSelector, function(e) {
            e.preventDefault();
            var parent = $(this).parents($(this).data('target') || '.form-group');
            var related = $(parent.data('related'));
            related.remove();
            parent.remove();
        });
    }

    function start() {
        $('.add-fields').each(function(i, el) {
            var data = $(el).data('addFields')
            if (!data) {
                $(el).data('addFields', new addFields(el))
            }
        })
    }

    start();
});