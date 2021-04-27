
/**
 * Sets the value of the text associated with a
 * textarea to the number of characters spaces
 * left remaining in that textarea
 */
const textarea = document.querySelector('textarea');
const max_len = textarea.getAttribute('maxlength');
const cur_len = textarea.value.length;
const diff = max_len - cur_len;
document.getElementById('char_count').innerHTML = diff + " chars. remaining";

/**
 * Add an event listener that dynamically updates
 * the text associated with a textarea to display
 * how many characters are still available for entry
 * into the textarea
 */
textarea.addEventListener('input', ev => {
    const target = ev.currentTarget;
    const max_len = target.getAttribute('maxlength');
    const cur_len = target.value.length;
    const diff = max_len - cur_len;
    document.getElementById('char_count').innerHTML = diff + " chars. remaining";
});


