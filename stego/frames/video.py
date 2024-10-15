import moviepy.editor as mp
from pydub import AudioSegment
import tempfile

# Load video file
video = mp.VideoFileClip('input.mp4')

# Extract audio from video
audio = video.audio

# Write audio to a temporary file (in MP3 format)
with tempfile.NamedTemporaryFile(suffix='.mp3') as tmp:
    audio.write_audiofile(tmp.name)

    # Create AudioSegment from temporary file
    audio_segment = AudioSegment.from_file(tmp.name)

    # Convert audio to WAV format
    audio_segment.export('audio_file.wav', format='wav')

# Remove audio from video
video.audio = None

# Save video to a file
video.write_videofile('input_na.mp4')
