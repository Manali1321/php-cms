const events = document.querySelectorAll('#category');
const eventNames = document.querySelectorAll('#category .category-item h3');

// Add a click event listener to each name of event
events.forEach((event) => {
  event.addEventListener('click', () => {
    const eventName = event.querySelector('h3').textContent;
    window.location.href = '/php-cms/event.php?name=' + encodeURIComponent(eventName);
  })
});
