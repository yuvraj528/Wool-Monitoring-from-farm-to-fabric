from geopy.geocoders import Nominatim

def reverse_geocode(latitude, longitude):
    geolocator = Nominatim(user_agent="reverse_geocoding")
    location = geolocator.reverse((latitude, longitude))
    return location

# Replace these coordinates with the ones you want to trace
latitude = 32.7266
longitude = 74.8570

location = reverse_geocode(latitude, longitude)
print(location.address)