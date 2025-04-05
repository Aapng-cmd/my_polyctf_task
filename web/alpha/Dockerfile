FROM alpine:latest

# Install necessary packages (if any)
RUN apk add --no-cache go sqlite sqlite-dev

# Set the Current Working Directory inside the container
WORKDIR /app

COPY src/ ./

RUN go mod init myapp
RUN go mod tidy
RUN go mod download

# Build the Go app
RUN go run setup_db.go
RUN go build -o main main.go

RUN chmod +x main


# Expose port 8080 to the outside world
EXPOSE 80

# Command to run the executable
CMD ["/app/main"]
