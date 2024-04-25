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
async function sendVisitData(pageUrl, visitorId) {
    try {
        const timestamp = Date.now(); // Get current timestamp in milliseconds
        const url = 'http://127.0.0.1:8000/track-visit';

        const response = await fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ pageUrl, timestamp, visitorId })
        });

        const responseData = await response.json();

        // If the visit is successfully tracked, remove the page URL from local storage
        if (response.ok && responseData.message === 'Visit tracked successfully') {
            return true;
        }

        return false;
    } catch (error) {
        console.error('Error sending visit data:', error);
        throw error;
    }
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

function cleanUrl(url) {
    // Remove trailing "#" if present
    if (url.endsWith('#')) {
        url = url.slice(0, -1);
    }

    // Remove trailing "?" if present
    if (url.endsWith('?')) {
        url = url.slice(0, -1);
    }

    // Remove trailing "?#" if present
    if (url.endsWith('?#')) {
        url = url.slice(0, -2);
    }

    return url;
}

// Call sendVisitData function for unique page visits on page load
window.addEventListener('load', async function () {
    try {
        // const pageUrl = window.location.pathname + window.location.search;
        const pageUrl = cleanUrl(window.location.href);

        if (isUniqueVisitor()) {
            const visitorId = await generateVisitorUniqueId(); // Generate if not exists
            const addToLocalStorage = await sendVisitData(pageUrl, visitorId);
            if(addToLocalStorage) {
                setVisitorId(visitorId);
                setVisitedPage(pageUrl);
            }

        } else if (!hasVisitedPage(pageUrl)) {
            const visitorId = getItem('visitor_id');
            const addToLocalStorage = await sendVisitData(pageUrl, visitorId);

            if(addToLocalStorage) {
                setVisitedPage(pageUrl);
            }
        }
    } catch (error) {
        console.error('Error processing visit data:', error);
    }
});
