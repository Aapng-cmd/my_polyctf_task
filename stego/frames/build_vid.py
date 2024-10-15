from moviepy.editor import *

# Load the video file
video = VideoFileClip("input_na.mp4")

# Load the audio file (now in .mp3 format)
audio = AudioFileClip("audio_file_m.wav")

# Trim the video file to match the duration of the audio file
video_trimmed = video.subclip(0, audio.duration)

# Set the audio of the video to the audio file
video_with_audio = video_trimmed.set_audio(audio)

# Write the video with the new audio to a file
video_with_audio.write_videofile("task.mp4")
