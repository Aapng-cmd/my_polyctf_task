import time

def timestamp_to_date(timestamp):
    """
    Converts a Unix timestamp to a formatted date string with precision up to minutes.

    :param timestamp: The Unix timestamp (float)
    :return: The formatted date string
    """
    dt_object = time.localtime(timestamp)
    date_string = time.strftime("%Y-%m-%d %H:%M", dt_object)
    return date_string

def date_to_timestamp(date_string):
    """
    Converts a formatted date string to a Unix timestamp with precision up to minutes.

    :param date_string: The formatted date string
    :return: The Unix timestamp (float)
    """
    dt_object = time.strptime(date_string, "%Y-%m-%d %H:%M")
    timestamp = time.mktime(dt_object)
    return timestamp


timestamp = time.time()
print("Original timestamp:", timestamp)

date_string = timestamp_to_date(timestamp)
print("Formatted date string:", date_string)

new_timestamp = date_to_timestamp(date_string)
print("New timestamp:", new_timestamp)

n = "2024-03-08 19:28"
new_timestamp = date_to_timestamp(n)
print("Need timestamp:", new_timestamp)
