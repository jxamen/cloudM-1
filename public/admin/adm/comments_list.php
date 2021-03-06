<?php
$sub_menu = "410200";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');


$sql = "select *
        from {$g5['contract_table']}
        order by id desc";
$contract = sql_fetch($sql);


$sql_common = " from {$g5['comment_table']} as a left join {$g5['project_table']} as b on a.project_id = b.id ";
$sql_common .= " left join {$g5['member_table']} as c on a.u_id = c.id ";

$sql_search = " where (1) ";

if ($stx) {
    $sql_search .= " and ( ";
    switch ($sfl) {
        case 'title' :
            $sql_search .= " ({$sfl} like '%{$stx}') ";
            break;
        default :
            $sql_search .= " ({$sfl} like '{$stx}%') ";
            break;
    }
    $sql_search .= " ) ";
}

/*
if ($is_admin != 'super')
    $sql_search .= " and mb_level <= '{$comment['mb_level']}' ";
*/

if (!$sst) {
    $sst = "a.id";
    $sod = "desc";
}

$sql_order = " order by {$sst} {$sod} ";

$sql = " select count(*) as cnt {$sql_common} {$sql_search} {$sql_order} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함


$listall = '<a href="'.$_SERVER['SCRIPT_NAME'].'" class="ov_listall">전체목록</a>';

$g5['title'] = '댓글 관리';
include_once('./admin.head.php');

$sql = " select *, a.id as com_id, b.id as p_id, c.id as user_id,
                    a.created_at as com_created_at {$sql_common} {$sql_search} {$sql_order} limit {$from_record}, {$rows} ";
$result = sql_query($sql);

$colspan = 16;
?>

<div class="local_ov01 local_ov">
    <?php echo $listall ?>
    총 <?php echo number_format($total_count) ?>건
</div>

<form id="fsearch" name="fsearch" class="local_sch01 local_sch" method="get">

    <label for="sfl" class="sound_only">검색대상</label>
    <select name="sfl" id="sfl">
        <option value="title"<?php echo get_selected($_GET['sfl'], "title"); ?>>프로젝트명</option>
    </select>
    <label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
    <input type="text" name="stx" value="<?php echo $stx ?>" id="stx" required class="required frm_input">
    <input type="submit" class="btn_submit" value="검색">

</form>


<form name="fcommentlist" id="fcommentlist" action="./comments_list_update.php" onsubmit="return fcommentlist_submit(this);" method="post">
    <input type="hidden" name="sst" value="<?php echo $sst ?>">
    <input type="hidden" name="sod" value="<?php echo $sod ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <input type="hidden" name="token" value="">
    <input type="hidden" name="p_id" value="<?php echo $p_id ?>">

    <div class="tbl_head02 tbl_wrap">
        <table>
            <caption><?php echo $g5['title']; ?> 목록</caption>
            <thead>
            <tr>
                <th scope="col" id="project_list_chk" rowspan="2">
                    <label for="chkall" class="sound_only">회원 전체</label>
                    <input type="checkbox" name="chkall" value="1" id="chkall" onclick="check_all(this.form)">
                </th>
                <th scope="col" id="project_list_mobile"><?php echo subject_sort_link('p_id') ?>프로젝트명</a></th>
                <th scope="col" id="project_list_mobile"><?php echo subject_sort_link('name') ?>지원자명</a></th>
				<th scope="col" id="project_list_mng"><?php echo subject_sort_link('type') ?>기업<br>형태</a></th>
				<th scope="col" id="project_list_mobile">연락처</th>


				<th scope="col" id="project_list_mobile">지원</th>
				<th scope="col" id="project_list_mobile">미팅</th>
                <th scope="col" id="project_list_mobile" rowspan="2">댓글내용</th>
                <th scope="col" id="project_list_lastcall"><?php echo subject_sort_link('secret', '', 'desc') ?>비밀글</a></th>
            </tr>

            <tr>
                <th scope="col" id="project_list_mobile">클라이언트사</th>
                <th scope="col" id="project_list_mng">파트너사</th>
                <th scope="col" id="project_list_mng">신원인증</th>
                <th scope="col" id="project_list_mobile">팩스</th>
                <th scope="col" id="project_list_mobile">계약</th>
                <th scope="col" id="project_list_mobile">완료</th>
                <th scope="col" id="project_list_lastcall"><?php echo subject_sort_link('created_at', '', 'desc') ?>작성일</a></th>
            </tr>

            </thead>
            <tbody>
            <?php
            for ($i=0; $row=sql_fetch_array($result); $i++) {

				$sql = "select count(*) as cnt
						from {$g5['comment_table']}
						where u_id = '$row[user_id]'";
				$step1 = sql_fetch($sql);

				$sql = "select count(*) as cnt
						from {$g5['contract_table']}
						where u_id = '$row[user_id]'
						where step = '계약'";
				$step2 = sql_fetch($sql);

                $sql = "select count(*) as cnt
						from {$g5['contract_table']}
						where u_id = '$row[user_id]'
						where step = '미팅'";
                $step3 = sql_fetch($sql);

				$sql = "select count(*) as cnt
						from {$g5['contract_table']}
						where u_id = '$row[user_id]'
						where step = '대금지급' or step = '완료'";
				$step4 = sql_fetch($sql);

                $sql = "select *
						from {$g5['member_table']}
						where id = '$row[Client_id]'";
                $client = sql_fetch($sql);
                ?>

                <tr class="<?php echo $bg; ?>">
                    <td class="td_40" rowspan="2">
                        <input type="hidden" name="id[<?php echo $i ?>]" value="<?php echo $row['com_id'] ?>">

                        <input type="checkbox" name="chk[]" value="<?php echo $i ?>" id="chk_<?php echo $i ?>">
                    </td>
                    <td class="l td_150"><a href="project_form.php?id=<?=$row['p_id']?>&w=u"><?php echo $row['title'] ?></a></td>

                    <td class="td_date"><a href="partner_form.php?id=<?=$row['user_id']?>&w=u"> <?php echo $row[name] ?></a></td>

					<td class="td_40"><?=$row['company_type']?></td>

                    <td class="td_60"><?php echo $row['phone_num'] ?></td>
					<td class="td_30"><?=number_format($step1['cnt']);?></td>
					<td class="td_30"><?=number_format($step2['cnt']);?></td>
                    <td class="td_250" rowspan="2"><textarea name="comment[<?php echo $i ?>]" rows="4"><?php echo $row['comment'] ?></textarea></td>
                    <td headers="project_list_lastcall" class="td_date"><input type="checkbox" name="secret[<?php echo $i ?>]" value="1" <?=($row['secret'])?"checked":""?>></td>
                </tr>




                <tr class="<?php echo $bg; ?>">
                    <td class="l"><a href="client_form.php?id=<?=$row['c_id']?>&w=u"><?php echo $client['name'] ?></a></td>
                    <td class="td_100"><a href="partner_form.php?id=<?=$row['user_id']?>&w=u"><?php echo $row['company_name'] ?></a></td>
                    <td class="td_date"><?=$row['auth_check']?></td>
                    <td class="td_60"><?=$row['fax_num'] ?></td>
                    <td class="td_30"><?=number_format($step3['cnt']);?></td>
                    <td class="td_30"><?=number_format($step4['cnt']);?></td>
                    <td headers="project_list_lastcall" class="td_date"><?php echo $row['com_created_at'] ?></td>
                </tr>

                <?php
            }
            if ($i == 0)
                echo "<tr><td colspan=\"".$colspan."\" class=\"empty_table\">자료가 없습니다.</td></tr>";
            ?>
            </tbody>
        </table>
    </div>

    <div class="btn_list01 btn_list">
        <input type="submit" name="act_button" value="선택수정" onclick="document.pressed=this.value">
        <input type="submit" name="act_button" value="선택삭제" onclick="document.pressed=this.value">
    </div>

</form>


<form name="fapp" method="post">
    <input type="hidden" name="act_button" value="계약">
    <input type="hidden" name="p_id" value="<?=$_GET['p_id']?>">
    <input type="hidden" name="u_id">
    <input type="hidden" name="c_id">
    <input type="hidden" name="chk[]">
</form>

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?'.$qstr.'&amp;page='); ?>


<script>
    function fcommentlist_submit(f)
    {
        if (!is_checked("chk[]")) {
            alert(document.pressed+" 하실 항목을 하나 이상 선택하세요.");
            return false;
        }

        if(document.pressed == "선택삭제") {
            if(!confirm("선택한 자료를 정말 삭제하시겠습니까?")) {
                return false;
            }
        }

        return true;
    }
</script>



<?php
include_once ('./admin.tail.php');
?>


