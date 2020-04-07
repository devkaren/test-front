require('./bootstrap');

(function ($) {
    function getFormData(form) {
        var formObj = {};
        var inputs  = form.serializeArray();

        $.each(inputs, function (i, input) {
            if (input.name == '_token') {
                return;
            }

            formObj[input.name] = input.value;
        });

        return formObj;
    }

    $('#add-article-form').on('submit', function (event) {
        event.preventDefault();

        var validate = $(this)[0].checkValidity();

        if (validate !== false) {
            $(this).removeClass('was-validated');

            var id      = Date.now();
            var page_id = $(this).data('page-id');
            var fields  = getFormData($(this));
            var data    = {
                'method': 'api_add_article',
                'params': {
                    'page_uid': page_id,
                    'fields': fields
                },
                'id': id,
                'jsonrpc': "2.0"
            };

            $.ajax({
                url: json_rpc_server,
                type: 'POST',
                data: JSON.stringify(data),
                headers: { 'X-Tochka-Access-Key': token },
                dataType: 'json',
                success: function (res) {
                    if (res.result) {
                        var article = res.result;

                        var html = `<div class="col-lg-3 col-md-6 mb-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <h4 class="card-title text-left">` + article.fields.title + `</h4>
                                                <p class="card-text" title="` + article.fields.description + `">
                                                    ` + article.fields.description.substring(0, 150) + `
                                                </p>
                                                <p class="text-left">Author: ` + article.fields.author + `</p>
                                            </div>
                                        </div>
                                    </div>`;
                        $(".articles").prepend(html);
                        $('#add-article-modal').modal('hide');
                        $('#add-article-form')[0].reset();
                    }
                }
            });

        } else {
            $(this).addClass('was-validated');
        }
    });
})(jQuery);
