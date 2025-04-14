$(document).ready(function(){
    $(document).on("click", "button#populate", function(e)
    {
        $.ajax({
            type: "GET",
            cache: false,
            url: 'index.php?action=ajax&function=populate',
            dataType: 'json',
            success: function(data)
            {
                if (data)
                {
                    $.each(data, function(i)
                    {
                        var item = data[i];
                        console.log(item.target);
                        $(item.target).html(item.content);
                    });
                }
            }
        });
    });
});