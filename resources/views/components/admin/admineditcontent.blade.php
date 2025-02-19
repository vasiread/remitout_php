<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
@extends('layouts.app')

@section('content')
<div class="edit-content-main-section" id="edit-content-main-section-id">
    <div class="edit-content-container" id="edit-content-header-section-id">
        <div class="edit-content-header">
            <h1 class="edit-content-header-title">Edit Content</h1>
            <input type="text" placeholder="Search" class="edit-content-search-input">
            
        </div>
        <div class="edit-content-list"></div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/adminsidebar.js') }}"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const contentData = [
            { name: "Landing Page", sections: 4, tags: ["Text", "Img"] },
            { name: "Contact Page", sections: 2, tags: ["Text", "Img", "Video"] },
            { name: "About Us", sections: 3, tags: ["Text"] },
            { name: "Services", sections: 5, tags: ["Text", "Video"] }
        ];

        const contentList = document.querySelector('.edit-content-list');

        function renderContent(data) {
            contentList.innerHTML = '';
            data.forEach(item => {
                const row = document.createElement('div');
                row.classList.add('edit-content-row');
                row.innerHTML = `
                    <div>${item.name}</div>
                    <div>${item.sections} Sections</div>
                    <div class="edit-content-tag-container">
                        ${item.tags.map(tag => `<span class="edit-content-tag">${tag}</span>`).join('')}
                    </div>
                    <button class="edit-content-button">Edit</button>
                `;
                row.querySelector('.edit-content-button').addEventListener('click', () => alert(`Editing ${item.name}`));
                contentList.appendChild(row);
            });
        }

        document.querySelector('.edit-content-search-input').addEventListener('input', function () {
            const searchTerm = this.value.toLowerCase();
            const filteredData = contentData.filter(item => item.name.toLowerCase().includes(searchTerm));
            renderContent(filteredData);
        });

        renderContent(contentData);
    });
</script>
@endsection



</body>

</html>