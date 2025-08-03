
const AssemblyAI = require('assemblyai');
const fs = require('fs');
const path = require('path');

const client = new AssemblyAI({
    apiKey: "92b5b6f11f03485ba4bfe178ca706502"
});

const filePath = process.argv[2]; // This will be the path to the uploaded audio file
const audioFile = fs.readFileSync(path.resolve(filePath));

const config = {
    audio_data: audioFile.toString('base64')
};

(async () => {
    const transcript = await client.transcripts.transcribe(config);
    console.log(transcript.text);
})();
