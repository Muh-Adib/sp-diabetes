$(function () {
    $('[data-toggle="tooltip"]').tooltip()
  })
$(function () {
    $('[data-toggle="popover"]').popover()
  })
function updateTextInput(val) {
    var range = val/10
    document.getElementById('textInput').value=range; 
  }
  $('#exampleModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var penyakit = button.data('penyakit') // Extract info from data-* attributes
    var idPenyakit = button.data('id')// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    var modal = $(this)
    modal.find('.modal-title').text('Gejala Penyakit ' + penyakit)
    modal.find('.id_Penyakit').val(idPenyakit)
    
  })
  
  function selectGejala(gj) {
    const val=gj
    document.getElementById('detail_gejala').value=gj 
    document.getElementById('id_Gejala').value=(event.target.id) 
    
  }
  
  const form = document.getElementById('step-form');
const summary = document.getElementById('step-summary');
const clear = document.getElementById('step-clear');

// Remove all children of the summary list.
function clearSummary() {
  while(summary.firstElementChild) {
    summary.firstElementChild.remove();
  }
}

// Clear list on click.
clear.addEventListener('click', event => {
  clearSummary();
});

form.addEventListener('submit', event => {
  // Clear list first.
  clearSummary();
  
  // Create a fragment to store the list items in.
  // Get the data from the form.
  const fragment = new DocumentFragment();
  const formData = new FormData(event.target);

  // Turn each entry into a list item which display
  // the name of the input and its value.
  // Add each list item to the fragment.
  for (const [ name, value ] of formData) {
    const listItem = document.createElement('li');
    listItem.textContent = `${name}: ${value}`;
    fragment.appendChild(listItem);
  }

  // Add all list items to the summary.
  summary.appendChild(fragment);
  event.preventDefault();
});