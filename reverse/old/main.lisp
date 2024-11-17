(defun string-to-number (string)
  (reduce #'+ (map 'list (lambda (char) (char-code char)) string)))

(defun number-to-string (number)
  (let ((chars '()))
    (loop while (> number 0) do
      (let ((char-code (mod number 256)))
        (push (code-char char-code) chars)
        (setf number (floor number 256))))
    (apply #'string (nreverse chars))))

(defun encrypt-number (number key)
  (+ number key))

(defun decrypt-number (number key)
  (- number key))

(defun encrypt-string (string key)
  (let ((number (string-to-number string)))
    (let ((encrypted-number (encrypt-number number key)))
      (number-to-string encrypted-number))))

(defun decrypt-string (encrypted-string key)
  (let ((number (string-to-number encrypted-string)))
    (let ((decrypted-number (decrypt-number number key)))
      (number-to-string decrypted-number))))

(defun example ()
  (let* ((original-string "Hello, World!")
         (key 5)
         (encrypted-string (encrypt-string original-string key))
         (decrypted-string (decrypt-string encrypted-string key)))
    (format t "Original: ~a~%" original-string)
    (format t "Encrypted: ~a~%" encrypted-string)
    (format t "Decrypted: ~a~%" decrypted-string)))

(example)
