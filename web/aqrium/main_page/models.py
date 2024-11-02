from sqlalchemy import Column, Integer, String
from werkzeug.security import generate_password_hash
from sqlalchemy.ext.hybrid import hybrid_property
from database import Base

class User(Base):
    __tablename__ = 'users'
    id = Column(Integer, primary_key=True)
    name = Column(String(50), unique=True)
    role = Column(Integer, default=3)
    _password = Column(String())

    @hybrid_property
    def password(self):
        return self._password

    @password.setter
    def password(self, new_pass):
        new_password_hash = generate_password_hash(new_pass)
        self._password = new_password_hash

    def __init__(self, **data):
        l = ('confirm_password','submit','csrf_token')
        list(map(data.__delitem__, filter(data.__contains__,l)))
        super(User, self).__init__(**data)

    def __repr__(self):
        return f'<User {self.name!r}>'