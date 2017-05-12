$('#add-new').click(function() {
    var url = "/fieldscreate";
    $(location).attr('href', url);
});

$('.update').click(function() {
    var url = "/fieldsupdate/" + this.id;
    $(location).attr('href', url);
});

$('.delete').click(function(){
    var id = this.id;
    var name = $(this).closest('tr').attr('name');
    var r = confirm("Are you sure you want to delete this field from the list?");
    if (r) {
        $(this).closest('tr').fadeOut();
        fetch('/fields/' + id, {
            method: 'delete',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                'name': name
            })
        })
        .then(res => {
            if (res.ok)
                return res.json();
        });
    }
});