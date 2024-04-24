// Utility function to get an item from local storage
function getItem(key) {
    return JSON.parse(localStorage.getItem(key));
}

// Utility function to set an item in local storage
function setItem(key, value) {
    localStorage.setItem(key, JSON.stringify(value));
}

// Function to generate visitor unique ID
async function generateVisitorUniqueId() {
    try {
        const response = await fetch('http://127.0.0.1:8000/generate-unique-id');
        if (!response.ok) {
            throw new Error('Failed to generate visitor ID');
        }
        const data = await response.json();
        return data.visitor_id;
    } catch (error) {
        console.error('Error generating visitor ID:', error);
        throw error;
    }
}

// Function to send visit data to the backend
function sendVisitData(pageUrl, visitorId) {
    const timestamp = Date.now(); // Get current timestamp in milliseconds
    const url = 'http://127.0.0.1:8000/track-visit';
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    const xhr = new XMLHttpRequest();
    xhr.open('POST', url, true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken); // for Laravel applications
    xhr.send(JSON.stringify({ pageUrl, timestamp, visitorId }));
}

// Function to check if the visitor is unique
function isUniqueVisitor() {
    return getItem('visitor_id') === null;
}

// Function to check if the page has been visited
function hasVisitedPage(pageUrl) {
    const visitedPages = getItem('visited_pages') || [];
    return visitedPages.includes(pageUrl);
}

// Function to set the visitor ID in local storage
function setVisitorId(visitorId) {
    setItem('visitor_id', visitorId);
}

// Function to set the visited page in local storage
function setVisitedPage(pageUrl) {
    const visitedPages = getItem('visited_pages') || [];
    if (!visitedPages.includes(pageUrl)) {
        visitedPages.push(pageUrl);
        setItem('visited_pages', visitedPages);
    }
}

// Call sendVisitData function for unique page visits on page load
window.addEventListener('load', async function () {
    try {
        // const pageUrl = window.location.pathname;
        const pageUrl = window.location.href;

        if (isUniqueVisitor()) {
            const visitorId = await generateVisitorUniqueId(); // Generate if not exists
            setVisitorId(visitorId);
            sendVisitData(pageUrl, visitorId);
            setVisitedPage(pageUrl);
        } else if (!hasVisitedPage(pageUrl)) {
            const visitorId = getItem('visitor_id');
            sendVisitData(pageUrl, visitorId);
            setVisitedPage(pageUrl);
        }
    } catch (error) {
        console.error('Error processing visit data:', error);
    }
});
