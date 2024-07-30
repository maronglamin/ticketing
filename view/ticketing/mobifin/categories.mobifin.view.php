<div class="container-fluid">
    <h2 
        class="h3 mb-1 text-gray-800 text-uppercase">
        <?=$heading?>
    </h2>
    <p class="mb-4"><?=$instruction?></p>

    <div class="row">

        <div class="col-lg-4">
            <div class="card mb-4">

                <div class="card-header">Categries entries</div>

                <div class="card-body">
                    <?=flash('success')?>
                    <form action="<?= route("mobifin/category/add") ?>" method="post">
                        <div class="row">
        
                            <div class="col-lg-12 mb-3">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="parent">Parent</label>
                                    </div>
                                    <select class="custom-select" name="parent" id="parent">
                                        <option value="0"></option>
                                        <?php foreach($parent as $category):?>
                                            <option value="<?=$category['id']?>"><?=$category['category']?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                                <small>Set it black if the category is parent</small>

                            </div>

                            <div class="col-lg-12 mb-3">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="category">Category *</label>
                                    </div>
                                    <input type="text" id="category" name="category" class="form-control">
                                </div>

                                <?php if(isset($errors['category'])):?>
                                    <div><small style="color:red"><?=$errors['category']?></small></div>
                                <?php endif;?>
                            </div>

                            <div class="col-lg-12">
                                <input type="submit" value="Submit" class="btn btn-primary mt-3">
                            </div>

                        </div>
                    </form>
                </div>
                
            </div>
        </div>

        <!-- second section -->
        <div class="col-lg-8">
            <div class="card mb-4">

                <div class="card-header">Recent Requests</div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table 
                            class="table 
                            table-borderless"
                            width="100%" 
                            cellspacing="0">

                            <thead>
                                <tr>
                                    <th>CATEGORY</th>
                                    <th>LABEL</th>
                                    <th>MAKER</th>
                                    <th>Parent Create At</th>
                                    <th></th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach($data as $value): ?>
                                        <tr>
                                            <td><a href="<?= route('status/ticket?ticketing=') ?>"><strong><?= $value['category'] ?></strong></a></td>
                                            <td><?= ($value['parent'] === '0')? 'Parent': 'Sub category' ?></td>
                                            <td><strong><?= $value['maker_id'] ?></strong></td>
                                            <td><?= human($value['make_at']) ?></td>

                                            <td>
                                            <form method="post" action="<?= route('mobifin/category/delete')?>" role="button">
                                                <input 
                                                    type="hidden"
                                                    name="_method"
                                                    value="DELETE">

                                                <input 
                                                    type="hidden"
                                                    name="id"
                                                    value="<?=$value['id']?>">

                                                <i class="fas fa-trash fa-sm fa-fw mr-2 text-gray-400"></i>
                                                <button class="session-button">Delete</button>
                                            </form>
                                            </td>
                                    <?php foreach(Http\model\mobifin\CategoryModel::getChild('mpr_catergories', $value['id']) as $child):?>
                                        <tr class="bg-info text-white">
                                            <td><a class="text-white" href="<?= route('status/ticket?ticketing=') ?>"><strong><?= $child['category'] ?></strong></a></td>
                                            <td><?= ($child['parent'] === '0')? '<strong>Parent</strong>': '<strong>Sub category</strong>' ?></td>
                                            <td><strong><?= $child['maker_id'] ?></strong></td>
                                            <td>
                                            
                                            </td>

                                            <td>
                                                <form method="post" action="<?= route('mobifin/subcategory/delete')?>" role="button">
                                                    <input 
                                                        type="hidden"
                                                        name="_method"
                                                        value="DELETE">

                                                    <input 
                                                        type="hidden"
                                                        name="id"
                                                        value="<?=$child['id']?>">

                                                    <i class="fas fa-trash fa-sm fa-fw mr-2 text-white"></i>
                                                    <button class="session-button text-white">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                        
                                    </tr>
                                    <?php endforeach;?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>

                        
                    </div>

                </div>
                
            </div>
        </div>

    </div>

</div>