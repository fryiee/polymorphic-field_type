# Polymorphic Field Type

*anomaly.field_type.polymorphic*

#### A polymorphic relation field type.

The polymorphic field type a clean API to establish polymorphic relations between objects.

## Configuration

- `related` - the class string of the related model
- `title` - the related column to use as the option title 

The title option will default to the model's title column.  

#### Example

	config => [
	    'related' => 'Anomaly\UsersModule\User\UserModel',
	    'title' => 'username'
	]
