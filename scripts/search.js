document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('search');
    const resultsContainer = document.getElementById('results');

    searchInput.addEventListener('input', function() {
        const query = this.value.toLowerCase();
        
        if (query.length < 2) {
            resultsContainer.innerHTML = '';
            return;
        }

        fetch('../data/research.json')
            .then(response => response.json())
            .then(data => {
                const filtered = data.filter(paper => 
                    paper.title.toLowerCase().includes(query) ||
                    paper.abstract.toLowerCase().includes(query) ||
                    paper.keywords.some(kw => kw.toLowerCase().includes(query))
                );
                
                displayResults(filtered);
            })
            .catch(error => console.error('Error:', error));
    });

    function displayResults(papers) {
        if (papers.length === 0) {
            resultsContainer.innerHTML = '<p>No research papers found matching your search.</p>';
            return;
        }

        resultsContainer.innerHTML = papers.map(paper => `
            <div class="research-card">
                <h3>${paper.title}</h3>
                <p class="author">By ${paper.author} (${paper.year})</p>
                <p class="subject">Subject: ${paper.subject}</p>
                <p class="abstract">${paper.abstract.substring(0, 150)}...</p>
                <a href="${paper.file_url}" class="view-btn" target="_blank">View Paper</a>
            </div>
        `).join('');
    }
});