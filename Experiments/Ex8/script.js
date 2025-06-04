// Simulated server-side "database"
let score = {
    runs: 0,
    wickets: 0,
    overs: 0
  };
  
  // Fake AJAX functions
  function fakeAjaxGet(callback) {
    setTimeout(() => {
      callback(`
        <h3>Runs: ${score.runs} | Wickets: ${score.wickets} | Overs: ${score.overs}</h3>
      `);
    }, 200); // simulate delay
  }
  
  function fakeAjaxPost(action, callback) {
    setTimeout(() => {
      switch (action) {
        case 'run':
          score.runs += 1;
          break;
        case 'wicket':
          score.wickets += 1;
          break;
        case 'over':
          score.overs += 1;
          break;
        case 'reset':
          score = { runs: 0, wickets: 0, overs: 0 };
          break;
      }
      callback();
    }, 200); // simulate delay
  }
  
  $(document).ready(function () {
    function loadScore() {
      fakeAjaxGet(function (data) {
        $('#scoreboard').html(data);
      });
    }
  
    function updateScore(action) {
      fakeAjaxPost(action, function () {
        loadScore();
      });
    }
  
    $('#addRun').click(() => updateScore('run'));
    $('#addWicket').click(() => updateScore('wicket'));
    $('#addOver').click(() => updateScore('over'));
    $('#reset').click(() => updateScore('reset'));
  
    // Load the initial score
    loadScore();
  });
  