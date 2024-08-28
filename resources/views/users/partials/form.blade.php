<div class="form-group">
    <label for="prefixname">Prefix Name</label>
    <select name="prefixname" id="prefixname" class="form-control">
        <option value="">Select</option>
        <option value="Mr" {{ isset($user) && $user->prefixname == 'Mr' ? 'selected' : '' }}>Mr</option>
        <option value="Mrs" {{ isset($user) && $user->prefixname == 'Mrs' ? 'selected' : '' }}>Mrs</option>
        <option value="Ms" {{ isset($user) && $user->prefixname == 'Ms' ? 'selected' : '' }}>Ms</option>
    </select>
</div>

<div class="form-group">
    <label for="firstname">First Name</label>
    <input type="text" name="firstname" id="firstname" class="form-control" value="{{ old('firstname', $user->firstname ?? '') }}">
</div>

<div class="form-group">
    <label for="middlename">Middle Name</label>
    <input type="text" name="middlename" id="middlename" class="form-control" value="{{ old('middlename', $user->middlename ?? '') }}">
</div>

<div class="form-group">
    <label for="lastname">Last Name</label>
    <input type="text" name="lastname" id="lastname" class="form-control" value="{{ old('lastname', $user->lastname ?? '') }}">
</div>

<div class="form-group">
    <label for="suffixname">Suffix Name</label>
    <input type="text" name="suffixname" id="suffixname" class="form-control" value="{{ old('suffixname', $user->suffixname ?? '') }}">
</div>

<div class="form-group">
    <label for="username">Username</label>
    <input type="text" name="username" id="username" class="form-control" value="{{ old('username', $user->username ?? '') }}">
</div>

<div class="form-group">
    <label for="email">Email</label>
    <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email ?? '') }}">
</div>

<div class="form-group">
    <label for="password">Password</label>
    <input type="password" name="password" id="password" class="form-control">
</div>

<div class="form-group">
    <label for="photo">Photo</label>
    <input type="file" name="photo" id="photo" class="form-control-file">
</div>

<div class="form-group">
    <label for="type">User Type</label>
    <select name="type" id="type" class="form-control">
        <option value="user" {{ isset($user) && $user->type == 'user' ? 'selected' : '' }}>User</option>
        <option value="admin" {{ isset($user) && $user->type == 'admin' ? 'selected' : '' }}>Admin</option>
    </select>
</div>
