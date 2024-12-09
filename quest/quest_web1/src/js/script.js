const spinButton = document.getElementById('spinButton');
const resultDiv = document.getElementById('result');

spinButton.addEventListener('click', () => {
    const reel1 = spinReel();
    const reel2 = spinReel();
    const reel3 = spinReel();

    document.getElementById('reel1').innerText = reel1;
    document.getElementById('reel2').innerText = reel2;
    document.getElementById('reel3').innerText = reel3;

    // Call the async function to check the result
    checkResult(reel1, reel2, reel3);
});

function spinReel() {
    const randomNumber = Math.floor(Math.random() * 10); // Generate a random number from 0 to 9
    return randomNumber;
}

async function generateHash(points) {
    const encoder = new TextEncoder();
    const data = encoder.encode(points.toString());
    const hashBuffer = await crypto.subtle.digest('SHA-1', data);
    const hashArray = Array.from(new Uint8Array(hashBuffer));
    const hash = hashArray.map(b => String.fromCharCode(b)).join('');
    return btoa(hash); // Encode to Base64 for transmission
}

// Make checkResult an async function
async function checkResult(reel1, reel2, reel3) {
    // Calculate points based on the formula: points = reel1 * 100 + reel2 * 10 + reel3
    const points = reel1 * 100 + reel2 * 10 + reel3;

    // Display result based on the points
    if (points > 0) {
        resultDiv.innerText = `You scored: ${points} points! 🎉`;
    } else {
        resultDiv.innerText = 'Try again!';
    }

    // Hash the points
    const hash = await generateHash(points); // Now this works since checkResult is async

    // Send results to index.php using fetch
    fetch('index.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ points: points, hash: hash })
    })
    .then(response => response.json())
    .then(data => {
        console.log('Success:', data);
    })
    .catch((error) => {
        console.error('Error:', error);
    });
}
