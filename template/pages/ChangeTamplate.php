{% extends "layout.twig" %}

{% block pagetitle %}
    {{ parent() }}

{% endblock %}

{% block content %}

    <!-- Dark Table -->
    <table class="table table">
        <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">title</th>
            <th scope="col">author</th>
            <th scope="col">image</th>
            <th scope="col">content</th>
        </tr>
        </thead>
        <tbody>

            <tr>
                <th scope="row">{{ article.id }}</th>
                <td>{{ article.title }}</td>
                <td>{{ article.author }}</td>
                <td>{{ article.image }}"</td>
                <td>{{article.content}}</td>
            </tr>

        </tbody>
    </table>

<table class="table table">

    <tbody>

    <tr>

    <form action='' method='POST'>
        <div>New Title:<input style='width: 100%' name='title_new' id='title_new'></div>
        <div>New Author:<input style='width: 100%' name='author_new' id='author_new'></div>
        <div>New Image:<input style='width: 100%' name='image_new' id='image_new'></div>
        <div>New Content:<input style='width: 100%' name='content_new' id='content_new'></div>
        <input value={{ article.id }} name='id' style='display: none;' id='id'>
        <div id="save" style="color: white; background: #0b5ed7; border-radius: 5px; font-size: 20px;font-weight: 600; margin-right: auto; margin-left: auto; width: 172px; margin-top: 40px; cursor: pointer"> SAVE CHANGES</div>
    </form>


    </tr>

    </tbody>
</table>
<script>
    const a = document.getElementById("save");
    const id = document.getElementById("id");
    const title = document.getElementById("title_new");
    const author = document.getElementById("author_new");
    const image = document.getElementById("image_new");
    const content = document.getElementById("content_new");

    function  valid (content) {
        if (content != ""){
            return content
        }
        else {
            return "none"
        }
    }


    String.prototype.replaceAt = function(index, replacement) {
        return this.substr(0, index) + replacement + this.substr(index + replacement.length);
    }

    a.addEventListener('click',function (){
        if (image.value != "") {
            let imagedone = image.value.replace(new RegExp('/', 'g'), '^');
            let a = imagedone.indexOf("?")
            if (a != -1) {
                let img = imagedone.replaceAt(a, "<")
                window.location.href = `/save/${id.value}/${valid(title.value)}/${valid(author.value)}/${img}/${valid(content.value)}`
            } else {
                window.location.href = `/save/${id.value}/${valid(title.value)}/${valid(author.value)}/${imagedone}/${valid(content.value)}`
            }
        }
        else {
            window.location.href = `/save/${id.value}/${valid(title.value)}/${valid(author.value)}/none/${valid(content.value)}`
        }
    })

</script>
    <!-- End Dark Table -->


{% endblock %}