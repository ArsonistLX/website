// Slideshow functionality
let slideIndex = 0; // Start with the 4th slide (index 3)
showSlides(slideIndex);

// Next/previous controls
function changeSlide(n) {
    showSlides(slideIndex += n);
}

// Thumbnail image controls
function currentSlide(n) {
    showSlides(slideIndex = n - 1);
}

function showSlides(n) {
    let i;
    const slides = document.getElementsByClassName("slideshow-slide");
    const dots = document.getElementsByClassName("slideshow-dot");
    
    if (n >= slides.length) {slideIndex = 0}
    if (n < 0) {slideIndex = slides.length - 1}
    
    for (i = 0; i < slides.length; i++) {
        slides[i].classList.remove("active");
    }
    
    for (i = 0; i < dots.length; i++) {
        dots[i].classList.remove("active");
    }
    
    slides[slideIndex].classList.add("active");
    dots[slideIndex].classList.add("active");
}

// Auto slideshow
setInterval(() => {
    changeSlide(1);
}, 5000);

// Reward slideshow functionality
let rewardSlideIndex = 0;
updateRewardSlide();

function slideReward(n) {
    rewardSlideIndex = (rewardSlideIndex + n + 2) % 2; // 2 is the total number of images
    updateRewardSlide();
}

function currentRewardSlide(n) {
    rewardSlideIndex = n;
    updateRewardSlide();
}

function updateRewardSlide() {
    const rewardSlideshow = document.querySelector('.reward-slideshow');
    const rewardDots = document.querySelectorAll('.reward-dot');
    
    if (rewardSlideshow) {
        rewardSlideshow.style.transform = `translateX(-${rewardSlideIndex * 100}%)`;
        
        // Update dots status
        rewardDots.forEach((dot, index) => {
            if (index === rewardSlideIndex) {
                dot.classList.add('active');
                dot.style.background = 'rgba(255,255,255,0.9)';
            } else {
                dot.classList.remove('active');
                dot.style.background = 'rgba(255,255,255,0.5)';
            }
        });
    }
}

// Auto rotate reward slideshow
setInterval(() => {
    slideReward(1);
}, 3000);

/*
// 随机评论词（显示的跟复制出来的一样，并且重复评论词后面域名也不一样）开始
function generateConsistentRandomDomains(commentText, settings) {
    const domainPositions = settings.domain_positions || [];
    const repeatDisplay = settings.repeat_display || 2;
    const repeatCopy = settings.repeat_copy || 2;
    
    let displayText = '';
    let copyText = '';
    
    // 获取随机域名池（如果启用）
    let domainPool = [settings.domain];
    if (settings.enable_random_domains && settings.random_domains && settings.random_domains.length > 0) {
        domainPool = [...settings.random_domains];
    }
    
    // 为这个评论词生成基于哈希的随机序列
    const hash = simpleHash(commentText);
    
    for (let i = 0; i < repeatDisplay; i++) {
        if (i > 0) {
            displayText += settings.separator || '<br>';
        }
        
        // 确定域名位置
        const position = domainPositions[i] || 'after';
        
        // 选择域名（基于哈希和行号）
        const domainIndex = (hash + i) % domainPool.length;
        const domain = domainPool[domainIndex];
        
        // 根据位置构建文本
        const lineText = position === 'before' 
            ? domain + commentText
            : commentText + domain;
            
        displayText += lineText;
    }
    
    // 生成复制文本（可能使用不同的重复次数）
    for (let i = 0; i < repeatCopy; i++) {
        if (i > 0) {
            copyText += settings.copy_as_text ? (settings.copy_separator || '\n') : '\n';
        }
        
        // 确定域名位置
        const position = domainPositions[i] || 'after';
        
        // 选择域名（基于哈希和行号）
        const domainIndex = (hash + i) % domainPool.length;
        const domain = domainPool[domainIndex];
        
        // 根据位置构建文本
        const lineText = position === 'before' 
            ? domain + commentText
            : commentText + domain;
            
        copyText += lineText;
    }
    
    // 处理纯文本复制
    if (settings.copy_as_text) {
        copyText = copyText.replace(/\n/g, settings.copy_separator || '\n');
    }
    
    return {
        display: displayText,
        copy: copyText
    };
}

// 更好的哈希函数（确保更好的随机分布）
function simpleHash(str) {
    let hash = 0;
    for (let i = 0; i < str.length; i++) {
        const char = str.charCodeAt(i);
        hash = ((hash << 5) - hash) + char;
        hash = hash & hash; // Convert to 32bit integer
    }
    return Math.abs(hash);
}

// 渲染评论词按钮（使用一致的随机域名）
function renderCommentButtons() {
    const selectedComments = getRandomComments();
    const commentContainer = document.getElementById('comment-buttons');
    if (!commentContainer) return;

    commentContainer.innerHTML = '';

    const settings = window.commentSettings || {
        domain: '347.bar',
        repeat_display: 2,
        repeat_copy: 2,
        separator: '<br>',
        default_color: '#1798fc',
        domain_positions: ['after', 'before', 'after'],
        copy_as_text: false,
        copy_separator: '\n',
        enable_random_domains: false
    };

    selectedComments.forEach(commentText => {
        const commentConfig = window.commentPool.find(item => item.text === commentText);
        const button = document.createElement('span');
        button.className = 'keyword-btn STYLE17';
        
        // 设置样式
        const color = getCommentColor(commentConfig, settings);
        const style = `style="color: ${color}; font-weight: bold;"`;
        
        // 生成一致的随机域名组合
        const result = generateConsistentRandomDomains(commentText, settings);
        
        button.innerHTML = `<strong ${style}>${result.display}</strong>`;
        
        // 存储复制文本到data属性
        button.setAttribute('data-copy-text', result.copy);
        button.setAttribute('data-comment-text', commentText);
        
        button.onclick = function() {
            const copyText = this.getAttribute('data-copy-text');
            const commentText = this.getAttribute('data-comment-text');
            copyCommentText(copyText, commentText);
        };
        
        commentContainer.appendChild(button);
    });
}
// 随机评论词（显示的跟复制出来的一样，并且重复评论词后面域名也不一样）结束
*/
// 生成带表情的评论词文本
function generateCommentWithEmoji(commentText, domain, position, index, settings) {
    const emojiSettings = window.emojiSettings || {
        enabled: false,
        pool: [],
        positions: [],
        random_position: false,
        repeat_with_comment: true
    };
    
    // 如果表情功能关闭，直接返回原始评论
    if (!emojiSettings.enabled || !emojiSettings.pool || emojiSettings.pool.length === 0) {
        return generateCommentLine(commentText, domain, position, index);
    }
    
    // 随机选择一个表情
    const randomEmoji = emojiSettings.pool[Math.floor(Math.random() * emojiSettings.pool.length)];
    
    // 确定表情位置
    let emojiPosition = emojiSettings.positions[index] || 'before';
    if (emojiSettings.random_position) {
        emojiPosition = Math.random() > 0.5 ? 'before' : 'after';
    }
    
    // 生成基础评论行
    const baseLine = generateCommentLine(commentText, domain, position, index);
    
    // 根据位置添加表情
    if (emojiPosition === 'before') {
        return randomEmoji + ' ' + baseLine;
    } else {
        return baseLine + ' ' + randomEmoji;
    }
}

// 生成随机域名组合（每次刷新都不同）
function generateRandomDomainsPerRefresh(commentText, settings) {
    const domainPositions = settings.domain_positions || [];
    const repeatDisplay = settings.repeat_display || 2;
    const repeatCopy = settings.repeat_copy || 2;
    const emojiSettings = window.emojiSettings || {
        enabled: false,
        repeat_with_comment: true
    };
    
    let displayText = '';
    let copyText = '';
    
    // 获取域名（固定或随机）- 每次刷新都随机选择
    let domain = settings.domain;
    if (settings.enable_random_domains && settings.random_domains && settings.random_domains.length > 0) {
        // 完全随机选择域名（不基于评论词哈希）
        const randomIndex = Math.floor(Math.random() * settings.random_domains.length);
        domain = settings.random_domains[randomIndex];
    }
    
    // 生成显示文本（根据设置决定是否显示表情）
    for (let i = 0; i < repeatDisplay; i++) {
        if (i > 0) {
            displayText += settings.separator || '<br>';
        }
        
        // 显示文本默认不显示表情
        const lineText = generateCommentLine(commentText, domain, domainPositions[i], i);
        displayText += lineText;
    }
    
    // 生成复制文本（根据设置决定是否包含表情）
    for (let i = 0; i < repeatCopy; i++) {
        if (i > 0) {
            copyText += settings.copy_as_text ? (settings.copy_separator || '\n') : '\n';
        }
        
        // 复制文本根据设置决定是否包含表情
        let lineText;
        if (emojiSettings.enabled && emojiSettings.repeat_with_comment) {
            lineText = generateCommentWithEmoji(commentText, domain, domainPositions[i], i, settings);
        } else if (emojiSettings.enabled && i === 0) {
            // 只在第一条评论加表情
            lineText = generateCommentWithEmoji(commentText, domain, domainPositions[i], i, settings);
        } else {
            lineText = generateCommentLine(commentText, domain, domainPositions[i], i);
        }
        
        copyText += lineText;
    }
    
    // 处理纯文本复制
    if (settings.copy_as_text) {
        copyText = copyText.replace(/\n/g, settings.copy_separator || '\n');
    }
    
    return {
        display: displayText,
        copy: copyText
    };
}

// 渲染评论词按钮（使用每次刷新都不同的随机域名）
function renderCommentButtons() {
    const selectedComments = getRandomComments();
    const commentContainer = document.getElementById('comment-buttons');
    if (!commentContainer) return;

    commentContainer.innerHTML = '';

    const settings = window.commentSettings || {
        domain: '347.bar',
        repeat_display: 2,
        repeat_copy: 2,
        separator: '<br>',
        default_color: '#1798fc',
        domain_positions: ['after', 'before', 'after'],
        copy_as_text: false,
        copy_separator: '\n',
        enable_random_domains: false,
        random_domain_position: true
    };

    const emojiSettings = window.emojiSettings || {
        enabled: false,
        repeat_with_comment: true
    };

    selectedComments.forEach(commentText => {
        const commentConfig = window.commentPool.find(item => item.text === commentText);
        const button = document.createElement('span');
        button.className = 'keyword-btn STYLE17';
        
        // 设置样式
        const color = getCommentColor(commentConfig, settings);
        const style = `style="color: ${color}; font-weight: bold;"`;
        
        // 生成评论词
        const result = generateRandomDomainsPerRefresh(commentText, settings);
        
        button.innerHTML = `<strong ${style}>${result.display}</strong>`;
        
        // 存储复制文本到data属性
        button.setAttribute('data-copy-text', result.copy);
        button.setAttribute('data-comment-text', commentText);
        
        button.onclick = function() {
            const copyText = this.getAttribute('data-copy-text');
            const commentText = this.getAttribute('data-comment-text');
            copyCommentText(copyText, commentText);
        };
        
        commentContainer.appendChild(button);
    });
}

// 复制评论词文本
function copyCommentText(copyText, commentText = '') {
    // 创建临时文本区域
    const tempTextArea = document.createElement('textarea');
    tempTextArea.value = copyText;
    tempTextArea.style.cssText = `
        position: fixed;
        opacity: 0;
        top: 0;
        left: 0;
        width: 1px;
        height: 1px;
        padding: 0;
        border: none;
        outline: none;
        boxShadow: none;
        background: transparent;
    `;
    document.body.appendChild(tempTextArea);

    // 选择并复制文本
    if (navigator.userAgent.match(/ipad|iphone/i)) {
        tempTextArea.contentEditable = true;
        tempTextArea.readOnly = false;
        const range = document.createRange();
        range.selectNodeContents(tempTextArea);
        const selection = window.getSelection();
        selection.removeAllRanges();
        selection.addRange(range);
        tempTextArea.setSelectionRange(0, 999999);
    } else {
        tempTextArea.select();
    }

    try {
        if (navigator.clipboard && window.isSecureContext) {
            navigator.clipboard.writeText(copyText).then(() => {
                showCustomToast(`"${commentText}" 已复制到剪贴板！`);
            }).catch(() => {
                document.execCommand('copy');
                showCustomToast(`"${commentText}" 已复制到剪贴板！`);
            });
        } else {
            const successful = document.execCommand('copy');
            if (successful) {
                showCustomToast(`"${commentText}" 已复制到剪贴板！`);
            } else {
                showCustomToast('复制失败，请手动复制', 'error');
            }
        }
    } catch (err) {
        console.error('复制失败:', err);
        showCustomToast('复制失败，请手动复制', 'error');
    }

    document.body.removeChild(tempTextArea);
}

// 获取随机评论词
function getRandomComments() {
    const settings = window.commentSettings || {
        display_count: 6
    };
    
    if (!window.commentPool || window.commentPool.length === 0) {
        console.error('评论词池未加载');
        return ["不一样的火影", "备用评论词"];
    }
    
    // 提取所有固定评论词
    const fixedComments = window.commentPool
        .filter(item => item.fixed)
        .map(item => item.text);
    
    // 提取非固定评论词
    const normalComments = window.commentPool
        .filter(item => !item.fixed)
        .map(item => item.text);

    // 使用PHP配置的数量设置
    const needMore = Math.max(0, settings.display_count - fixedComments.length);

    // 随机选择补充的评论词
    const shuffledNormals = [...normalComments].sort(() => 0.5 - Math.random());
    const additionalComments = shuffledNormals.slice(0, needMore);

    // 合并结果
    return [...fixedComments, ...additionalComments];
}

// 初始化评论词
document.addEventListener('DOMContentLoaded', function() {
    // 等待配置加载完成
    if (window.commentPool && window.commentSettings) {
        renderCommentButtons();
    } else {
        setTimeout(() => {
            if (window.commentPool && window.commentSettings) {
                renderCommentButtons();
            } else {
                console.error('评论词配置加载失败，使用默认设置');
                window.commentSettings = window.commentSettings || {
                    display_count: 6,
                    domain: '347.bar',
                    repeat_display: 3,
                    repeat_copy: 3,
                    separator: '<br>',
                    default_color: '#1798fc',
                    enable_random_domains: false
                };
                renderCommentButtons();
            }
        }, 500);
    }
});


/*
// 修改复制关键词函数
function copyKeyword(keyword) {
    // 创建临时文本区域
    const tempTextArea = document.createElement('textarea');
    tempTextArea.value = keyword;
    tempTextArea.style.cssText = `
        position: fixed;
        opacity: 0;
        top: 0;
        left: 0;
        width: 1px;
        height: 1px;
        padding: 0;
        border: none;
        outline: none;
        boxShadow: none;
        background: transparent;
    `;
    document.body.appendChild(tempTextArea);

    // 选择并复制文本
    if (navigator.userAgent.match(/ipad|iphone/i)) {
        // iOS设备需要特殊处理
        tempTextArea.contentEditable = true;
        tempTextArea.readOnly = false;
        
        // 创建一个范围并选择文本
        const range = document.createRange();
        range.selectNodeContents(tempTextArea);
        const selection = window.getSelection();
        selection.removeAllRanges();
        selection.addRange(range);
        tempTextArea.setSelectionRange(0, 999999);
    } else {
        // 其他设备
        tempTextArea.select();
    }

    try {
        // 尝试使用现代API
        if (navigator.clipboard && window.isSecureContext) {
            navigator.clipboard.writeText(keyword).then(() => {
                showCustomToast(`"${keyword}" 已复制到剪贴板！`);
            }).catch(() => {
                // 如果现代API失败，回退到传统方法
                document.execCommand('copy');
                showCustomToast(`"${keyword}" 已复制到剪贴板！`);
            });
        } else {
            // 在不支持 navigator.clipboard 的环境中使用传统方法
            const successful = document.execCommand('copy');
            if (successful) {
                showCustomToast(`"${keyword}" 已复制到剪贴板！`);
            } else {
                showCustomToast('复制失败，请手动复制', 'error');
            }
        }
    } catch (err) {
        console.error('复制失败:', err);
        showCustomToast('复制失败，请手动复制', 'error');
    }

    // 清理临时元素
    document.body.removeChild(tempTextArea);
}


// 添加触摸事件支持

// 关键词配置（可自由设置fixed属性）
const keywordPool = [
  { text: "火影同人", weight: 1000, fixed: true, color: "red" },
  { text: "张力大比拼这一块", weight: 20, fixed: false },
  { text: "火影笨子这方面", weight: 20, fixed: false },
  { text: "同人作品", weight: 20, fixed: false },
  { text: "二次元动漫", weight: 20, fixed: false },
  { text: "火影纲手雏田", weight: 20, fixed: false },
  { text: "女忍者训练师", weight: 20, fixed: false },
  { text: "火影忍者寻人启事", weight: 20, fixed: false },
  { text: "权威火影这一块", weight: 20, fixed: false },
  { text: "查克拉羁绊催泪", weight: 20, fixed: false },
  { text: "晴晴小本", weight: 20, fixed: false },
  { text: "静静宝库", weight: 20, fixed: false },
  { text: "火影同人新作", weight: 20, fixed: false },
  { text: "同人动漫", weight: 20, fixed: false },
  { text: "绝区零同人", weight: 20, fixed: false },
  { text: "小樱纲手借口寻人", weight: 20, fixed: false },
  { text: "小静本本", weight: 20, fixed: false },
  { text: "火影这一块", weight: 20, fixed: false },
];

// 智能关键词选择函数（自动识别固定关键词数量）
function getRandomKeywords() {
  // 提取所有固定关键词（不限制数量）
  const fixedKeywords = keywordPool
    .filter(item => item.fixed)
    .map(item => item.text);
  
  // 提取非固定关键词（排除已固定的）
  const normalKeywords = keywordPool
    .filter(item => !item.fixed && !fixedKeywords.includes(item.text))
    .map(item => item.text);

  // 计算总显示数量（2-4个，至少显示所有固定关键词）
  const minTotal = Math.max(6, fixedKeywords.length); // 最少显示6个关键词
  const maxTotal = 6;  //最多显示6个关键词
  const totalCount = minTotal + Math.floor(Math.random() * (maxTotal - minTotal + 1));

  // 需要补充的随机关键词数量
  const needMore = Math.max(0, totalCount - fixedKeywords.length);

  // 随机选择补充的关键词
  const shuffledNormals = [...normalKeywords].sort(() => 0.5 - Math.random());
  const additionalKeywords = shuffledNormals.slice(0, needMore);

  // 合并结果
  return [...fixedKeywords, ...additionalKeywords];
}

// 渲染函数
function renderKeywords() {
  const selectedKeywords = getRandomKeywords();
  const keywordContainer = document.querySelector('.image-container');
  if (!keywordContainer) return;

  // 清空容器
  const existingButtons = keywordContainer.querySelectorAll('.keyword-btn.STYLE17');
  existingButtons.forEach(btn => btn.remove());

  // 渲染关键词
  selectedKeywords.forEach((keyword, index) => {
    // 查找关键词的完整配置
    const keywordConfig = keywordPool.find(item => item.text === keyword);
    
    const button = document.createElement('span');
    button.className = 'keyword-btn STYLE17';
    
    // 设置基础样式
    button.style = `
      margin: 10px; 
      display: inline-block;
    `;
    // 如果有设置颜色，则添加样式
    const colorStyle = keywordConfig?.color ? `style="color: ${keywordConfig.color}; font-weight: bold;"` : '';
    button.innerHTML = `<strong ${colorStyle}>${keyword}</strong>`;
    button.onclick = () => copyKeyword(keyword);

    // 换行逻辑（第2、4、6...个关键词前换行）
    //if (index > 0 && index % 2 === 0) {
     // keywordContainer.appendChild(document.createElement('br'));
    //}

    keywordContainer.appendChild(button);
  });
}*/

// 复制关键词函数（使用PHP配置）
function copyKeyword(keyword) {
    // 查找关键词的完整配置
    const keywordConfig = window.keywordPool.find(item => item.text === keyword);
    const settings = window.keywordSettings || {
        default_color: '#333333'
    };
    
    // 创建临时文本区域
    const tempTextArea = document.createElement('textarea');
    tempTextArea.value = keyword;
    tempTextArea.style.cssText = `
        position: fixed;
        opacity: 0;
        top: 0;
        left: 0;
        width: 1px;
        height: 1px;
        padding: 0;
        border: none;
        outline: none;
        boxShadow: none;
        background: transparent;
    `;
    document.body.appendChild(tempTextArea);

    // 选择并复制文本
    if (navigator.userAgent.match(/ipad|iphone/i)) {
        tempTextArea.contentEditable = true;
        tempTextArea.readOnly = false;
        const range = document.createRange();
        range.selectNodeContents(tempTextArea);
        const selection = window.getSelection();
        selection.removeAllRanges();
        selection.addRange(range);
        tempTextArea.setSelectionRange(0, 999999);
    } else {
        tempTextArea.select();
    }

    try {
        if (navigator.clipboard && window.isSecureContext) {
            navigator.clipboard.writeText(keyword).then(() => {
                showCustomToast(`"${keyword}" 已复制到剪贴板！`);
            }).catch(() => {
                document.execCommand('copy');
                showCustomToast(`"${keyword}" 已复制到剪贴板！`);
            });
        } else {
            const successful = document.execCommand('copy');
            if (successful) {
                showCustomToast(`"${keyword}" 已复制到剪贴板！`);
            } else {
                showCustomToast('复制失败，请手动复制', 'error');
            }
        }
    } catch (err) {
        console.error('复制失败:', err);
        showCustomToast('复制失败，请手动复制', 'error');
    }

    document.body.removeChild(tempTextArea);
}

// 智能关键词选择函数（使用PHP配置）
function getRandomKeywords() {
    const settings = window.keywordSettings || {
        min_keywords: 6,
        max_keywords: 6
    };
    
    if (!window.keywordPool || window.keywordPool.length === 0) {
        console.error('关键词池未加载');
        return ["火影同人", "备用关键词1", "备用关键词2"];
    }
  
    // 提取所有固定关键词
    const fixedKeywords = window.keywordPool
        .filter(item => item.fixed)
        .map(item => item.text);
  
    // 提取非固定关键词
    const normalKeywords = window.keywordPool
        .filter(item => !item.fixed)
        .map(item => item.text);

    // 使用PHP配置的数量设置
    const minTotal = Math.max(settings.min_keywords, fixedKeywords.length);
    const maxTotal = settings.max_keywords;
    const totalCount = minTotal + Math.floor(Math.random() * (maxTotal - minTotal + 1));

    // 需要补充的随机关键词数量
    const needMore = Math.max(0, totalCount - fixedKeywords.length);

    // 随机选择补充的关键词
    const shuffledNormals = [...normalKeywords].sort(() => 0.5 - Math.random());
    const additionalKeywords = shuffledNormals.slice(0, needMore);

    // 合并结果
    return [...fixedKeywords, ...additionalKeywords];
}

// 渲染函数（使用PHP配置）
function renderKeywords() {
    const selectedKeywords = getRandomKeywords();
    const keywordContainer = document.querySelector('.image-container');
    if (!keywordContainer) return;

    // 清空容器
    keywordContainer.innerHTML = '';

    const settings = window.keywordSettings || {
        default_color: '#333333',
        line_break_after: 0
    };

    // 渲染关键词
    selectedKeywords.forEach((keyword, index) => {
        // 查找关键词的完整配置
        const keywordConfig = window.keywordPool.find(item => item.text === keyword);
        
        const button = document.createElement('span');
        button.className = 'keyword-btn STYLE17';
        
        // 设置基础样式（保留原有的margin）
        button.style.cssText = `
            margin: 5px; 
            display: inline-block;
            cursor: pointer;
        `;
        
        // 设置文字颜色（不覆盖其他样式）
        const color = getKeywordColor(keywordConfig, settings);
        button.innerHTML = `<strong style="color: ${color}; font-weight: bold;">${keyword}</strong>`;
        
        button.onclick = () => copyKeyword(keyword);
        keywordContainer.appendChild(button);

        // 换行逻辑
        if (settings.line_break_after > 0 && (index + 1) % settings.line_break_after === 0) {
            keywordContainer.appendChild(document.createElement('br'));
        }
    });
}

// 初始化关键词
document.addEventListener('DOMContentLoaded', function() {
    // 等待配置加载完成
    if (window.keywordPool && window.keywordSettings) {
        renderKeywords();
    } else {
        setTimeout(() => {
            if (window.keywordPool && window.keywordSettings) {
                renderKeywords();
            } else {
                console.error('关键词配置加载失败，使用默认设置');
                window.keywordSettings = window.keywordSettings || {
                    min_keywords: 6,
                    max_keywords: 6,
                    default_color: '#333333',
                    line_break_after: 0
                };
                renderKeywords();
            }
        }, 500);
    }
});
// 在页面加载完成后初始化触摸支持
document.addEventListener('DOMContentLoaded', function() {
    
    addTouchSupport();
});

// 修改显示自定义弹窗的样式，背景颜色改为白色
function showCustomToast(message, type = 'success') {
    // 检查是否已存在toast，如果有则先移除
    const existingToast = document.querySelector('.custom-toast');
    if (existingToast) {
        document.body.removeChild(existingToast);
    }

    // 创建toast元素
    const toast = document.createElement('div');
    toast.className = `custom-toast ${type}`;
    
    // 根据设备类型调整样式
    const isMobile = /iPhone|iPad|iPod|Android/i.test(navigator.userAgent);
    
    // 移动设备特定样式
    if (isMobile) {
        toast.style.cssText = `
            position: fixed;
            bottom: 80px; /* 调整位置避免被输入框遮挡 */
            left: 50%;
            transform: translateX(-50%);
            background: white;
            color: #333;
            padding: 12px 20px;
            border-radius: 8px;
            z-index: 10000;
            font-size: 14px;
            max-width: 90%;
            text-align: center;
            animation: fadeInUp 0.3s ease;
            box-shadow: 0 2px 10px rgba(0,0,0,0.15);
            border: 1px solid #eee;
        `;
    }
    
    // 设置内容
    toast.innerHTML = `
        <div class="toast-message">${message}</div>
    `;
    
    // 添加到body
    document.body.appendChild(toast);
    
    // 显示动画
    setTimeout(() => {
        toast.classList.add('show');
    }, 10);
    
    // 3秒后隐藏
    setTimeout(() => {
        toast.classList.remove('show');
        setTimeout(() => {
            if (toast.parentNode) {
                toast.parentNode.removeChild(toast);
            }
        }, 300);
    }, 3000);
}

// Download image function
function downloadImage() {
    const image = document.getElementById('downloadableImage');
    const link = document.createElement('a');
    
    // Create a canvas to convert the image
    const canvas = document.createElement('canvas');
    canvas.width = image.naturalWidth;
    canvas.height = image.naturalHeight;
    
    const ctx = canvas.getContext('2d');
    ctx.drawImage(image, 0, 0);
    
    // Create download link
    link.href = canvas.toDataURL('image/jpeg');
    link.download = '53bk.jpg';
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}

// Show task tip
function showTaskTip() {
    showCustomToast('〓取完整资源，请按照下面步骤完成任务〓！');
}

// Initialize on DOM loaded
document.addEventListener('DOMContentLoaded', function() {
    renderKeywords();
    // 初始化幻灯片
    showSlides(1);
    updateRewardSlide();
    
    // 初始化关键词按钮
    //updateKeywordButtons();
    
    // 初始化拖拽功能
    initDraggable();
    
    // 其他初始化代码...
});

// 模拟消息显示信息数量
let messageCount = 0;

// 显示悬浮窗
function show_floatWindow() {
    const floatWindow = document.getElementById('iframe_company_mini_div');
    const miniBtn = document.getElementById('mini-btn');
    
    if (floatWindow) {
        // 显示窗口
        floatWindow.style.display = 'block';
        
        // 重置窗口位置（防止之前拖动导致位置不当）
        if (!floatWindow.style.top) {
            const windowHeight = window.innerHeight;
            const windowWidth = window.innerWidth;
            const floatHeight = floatWindow.offsetHeight;
            const floatWidth = floatWindow.offsetWidth;
            
            // 设置初始位置在右下角
            floatWindow.style.bottom = '20px';
            floatWindow.style.right = '2px';
        }
        
        // 初始化拖拽功能
        initDraggable();
        
        // 如果有mini按钮，则隐藏
        if (miniBtn) {
            miniBtn.style.display = 'none';
        }
        
        // 清除消息提示
        resetMessageNotification();
    } else {
        // 如果窗口不存在，显示提示
        showCustomToast('聊天窗口正在加载中...', 'info');
    }
}

// 隐藏悬浮窗
function hide_floatWindow() {
    const floatWindow = document.getElementById('iframe_company_mini_div');
    const miniBtn = document.getElementById('mini-btn');
    
    if (floatWindow) {
        floatWindow.style.display = 'none';
    }
    
    if (miniBtn) {
        miniBtn.style.display = 'block';
    }
}

// 全局变量，标记图片是否通过审核
let lastImageVerified = false;
let lastVerificationResult = null;
// 全局变量，用于记录上传图片的数量
let imageUploadCount = 0;


/**增加图片文字识别，需要增加ocr接口来识别，所以未完成
// 全局变量，定义需要检测的关键词
const REQUIRED_KEYWORDS = ["评论规范", "评论要求", "评论规则"];

// 修改后的图片上传处理函数
function handleKfImageSelect(input) {
    if (input.files && input.files[0]) {
        // 首先显示用户发送的图片
        const reader = new FileReader();
        reader.onload = function(e) {
            // 添加用户消息显示图片
            addUserMessage(e.target.result, true);
            
            // 显示加载消息
            var loadingMsg = document.createElement('div');
            loadingMsg.className = 'loading-message';
            loadingMsg.innerHTML = '<div style="margin: 10px 0;"><div style="display: flex; align-items: flex-start; gap: 4px;"><div style="position: relative; min-width: 36px;"><img src="img/头像.png" style="width: 36px; height: 36px; border-radius: 50%; border: 2px solid #fff; box-shadow: 0 2px 4px rgba(0,0,0,0.1);"><span style="position: absolute; bottom: 0; right: 0; width: 10px; height: 10px; background: #4CAF50; border: 2px solid #fff; border-radius: 50%;"></span></div><div style="flex: 1; width: calc(100% - 40px);"><div style="display: flex; align-items: center; gap: 8px; margin-bottom: 4px;"><span style="font-size: 14px; color: #333; font-weight: 500;">审核员小雨</span><span style="font-size: 12px; color: #4CAF50; background: rgba(76, 175, 80, 0.1); padding: 2px 6px; border-radius: 10px;">在线中</span></div><div style="background: #fff; padding: 10px 12px; border-radius: 4px 12px 12px 12px; box-shadow: 0 1px 2px rgba(0,0,0,0.1); max-width: 98%; word-break: break-word;">正在审核图片，请稍候...</div></div></div></div>';
            document.getElementById('chat_content').appendChild(loadingMsg);
            document.getElementById('chat_content').scrollTop = document.getElementById('chat_content').scrollHeight;
            
            // 模拟OCR识别图片内容
            setTimeout(() => {
                // 这里模拟OCR识别结果 - 实际应用中应该调用OCR API
                const mockOcrResult = {
                    text: "这里是图片中的文字内容\n包含评论规范等重要信息\n请遵守社区规则",
                    containsKeywords: checkForKeywords("这里是图片中的文字内容\n包含评论规范等重要信息\n请遵守社区规则")
                };
                
                processImageVerification(input.files[0], mockOcrResult);
            }, 2000);
        };
        reader.readAsDataURL(input.files[0]);
    }
}

// 检查文本中是否包含关键词
function checkForKeywords(text) {
    return REQUIRED_KEYWORDS.some(keyword => 
        text.includes(keyword)
    );
}

// 处理图片验证结果
function processImageVerification(file, ocrResult) {
    // 移除加载消息
    const loadingMsg = document.querySelector('.loading-message');
    if (loadingMsg) {
        loadingMsg.remove();
    }

    // 创建响应消息
    const msgDiv = document.createElement('div');
    msgDiv.style.margin = '10px 0';
    
    let message = '';
    let isSuccess = false;
    
    if (ocrResult.containsKeywords) {
        // 增加上传图片的计数
        imageUploadCount++;
        lastImageVerified = true;
        isSuccess = true;
        
        message = `✅ 图片验证通过！检测到关键词: ${REQUIRED_KEYWORDS.join('或')}<br>当前已上传 ${imageUploadCount} 张图片，请继续上传剩余 ${3 - imageUploadCount} 张图片`;
    } else {
        lastImageVerified = false;
        message = `❌ 图片验证失败！未检测到关键词: ${REQUIRED_KEYWORDS.join('或')}<br>请上传包含"评论规范"等关键词的截图`;
    }

    // 添加AI回复
    var msgHtml = '<div style="display: flex; align-items: flex-start; gap: 4px;"><div style="position: relative; min-width: 36px;"><img src="img/头像.png" style="width: 36px; height: 36px; border-radius: 50%; border: 2px solid #fff; box-shadow: 0 2px 4px rgba(0,0,0,0.1);"><span style="position: absolute; bottom: 0; right: 0; width: 10px; height: 10px; background: #4CAF50; border: 2px solid #fff; border-radius: 50%;"></span></div><div style="flex: 1; width: calc(100% - 40px);"><div style="display: flex; align-items: center; gap: 8px; margin-bottom: 4px;"><span style="font-size: 14px; color: #333; font-weight: 500;">审核员小雨</span><span style="font-size: 12px; color: #4CAF50; background: rgba(76, 175, 80, 0.1); padding: 2px 6px; border-radius: 10px;">在线中</span></div>';
    msgHtml += `<div style="background: #fff; padding: 10px 12px; border-radius: 4px 12px 12px 12px; box-shadow: 0 1px 2px rgba(0,0,0,0.1); max-width: 98%; word-break: break-word;">${message}</div>`;
    msgHtml += '</div></div>';
    msgDiv.innerHTML = msgHtml;

    // 添加到聊天内容区域
    document.getElementById('chat_content').appendChild(msgDiv);
    document.getElementById('chat_content').scrollTop = document.getElementById('chat_content').scrollHeight;

    // 如果验证成功且达到3张图片，显示资源
    if (isSuccess && imageUploadCount === 3) {
        checkImageAndRespond();
    }
}
//增加图片文字识别，需要增加ocr接口来识别，所以未完成
*/

// 发出图片的时候，会显示图片开始
function handleKfImageSelect(input) {
    if (input.files && input.files[0]) {
        // 首先显示用户发送的图片
        const reader = new FileReader();
        reader.onload = function(e) {
            // 添加用户消息显示图片
            addUserMessage(e.target.result, true);
            
            // 然后显示加载消息
            var loadingMsg = document.createElement('div');
            loadingMsg.className = 'loading-message';
            loadingMsg.innerHTML = '<div style="margin: 10px 0;"><div style="display: flex; align-items: flex-start; gap: 4px;"><div style="position: relative; min-width: 36px;"><img src="tr/img/头像.png" style="width: 36px; height: 36px; border-radius: 50%; border: 2px solid #fff; box-shadow: 0 2px 4px rgba(0,0,0,0.1);"><span style="position: absolute; bottom: 0; right: 0; width: 10px; height: 10px; background: #4CAF50; border: 2px solid #fff; border-radius: 50%;"></span></div><div style="flex: 1; width: calc(100% - 40px);"><div style="display: flex; align-items: center; gap: 8px; margin-bottom: 4px;"><span style="font-size: 14px; color: #333; font-weight: 500;">审核员小雨</span><span style="font-size: 12px; color: #4CAF50; background: rgba(76, 175, 80, 0.1); padding: 2px 6px; border-radius: 10px;">在线中</span></div><div style="background: #fff; padding: 10px 12px; border-radius: 4px 12px 12px 12px; box-shadow: 0 1px 2px rgba(0,0,0,0.1); max-width: 98%; word-break: break-word;">正在审核图片，请稍候...</div></div></div></div>';
            document.getElementById('chat_content').appendChild(loadingMsg);
            document.getElementById('chat_content').scrollTop = document.getElementById('chat_content').scrollHeight;
        };
        reader.readAsDataURL(input.files[0]);

        var formData = new FormData();
        formData.append('file', input.files[0]);        
        // 增加上传图片的计数
        imageUploadCount++;
        // 模拟成功响应
        const mockSuccessResponse = {
            success: true,
            message: `图片上传成功，审核通过！当前已上传 ${imageUploadCount} 张图片，请继续上传剩余 ${3 - imageUploadCount} 张图片`,
            count: imageUploadCount,
            task_completed: true
        };

        // 模拟延迟响应
        setTimeout(() => {
            // 移除加载消息
            const loadingMsg = document.querySelector('.loading-message');
            if (loadingMsg) {
                loadingMsg.remove();
            }

            // 创建新的消息元素
            var msgDiv = document.createElement('div');
            msgDiv.style.margin = '10px 0';

            // 添加AI头像和名称
            var msgHtml = '<div style="display: flex; align-items: flex-start; gap: 4px;"><div style="position: relative; min-width: 36px;"><img src="img/头像.png" style="width: 36px; height: 36px; border-radius: 50%; border: 2px solid #fff; box-shadow: 0 2px 4px rgba(0,0,0,0.1);"><span style="position: absolute; bottom: 0; right: 0; width: 10px; height: 10px; background: #4CAF50; border: 2px solid #fff; border-radius: 50%;"></span></div><div style="flex: 1; width: calc(100% - 40px);"><div style="display: flex; align-items: center; gap: 8px; margin-bottom: 4px;"><span style="font-size: 14px; color: #333; font-weight: 500;">审核员小雨</span><span style="font-size: 12px; color: #4CAF50; background: rgba(76, 175, 80, 0.1); padding: 2px 6px; border-radius: 10px;">在线中</span></div>';

            // 添加消息内容
            if (mockSuccessResponse.html_message) {
                // 使用服务器返回的HTML消息
                msgHtml += mockSuccessResponse.html_message;
            } else if (mockSuccessResponse.message) {
                // 使用普通文本消息
                msgHtml += '<div style="background: #fff; padding: 10px 12px; border-radius: 4px 12px 12px 12px; box-shadow: 0 1px 2px rgba(0,0,0,0.1); max-width: 98%; word-break: break-word;">' + mockSuccessResponse.message + '</div>';
            } else if (!mockSuccessResponse.success) {
                // 显示错误消息
                msgHtml += '<div style="background: #fff; padding: 10px 12px; border-radius: 4px 12px 12px 12px; box-shadow: 0 1px 2px rgba(0,0,0,0.1); max-width: 98%; word-break: break-word; color: #f44336;">处理图片时出错: ' + (mockSuccessResponse.error || '未知错误') + '</div>';
            }

            msgHtml += '</div></div>';
            msgDiv.innerHTML = msgHtml;

            // 添加到聊天内容区域
            document.getElementById('chat_content').appendChild(msgDiv);
            document.getElementById('chat_content').scrollTop = document.getElementById('chat_content').scrollHeight;

            // 检查是否有进度信息
            if (mockSuccessResponse.count && mockSuccessResponse.count < 3) {
                console.log("审核进度: " + mockSuccessResponse.count + "/3");
            }

            // 检查是否任务完成
            if (mockSuccessResponse.task_completed) {
                console.log("任务完成!");
            }
            // 当上传图片数量达到5时，触发checkImageAndRespond函数
            if (imageUploadCount === 3) {
                checkImageAndRespond();
            }
        }, 1500); // 1.5秒延迟模拟网络请求
    }
}
// 发出图片的时候，会显示图片结束

/**原版图片发出没有显示开始
// 添加或修改图片上传处理函数
function handleKfImageSelect(input) {
    if (input.files && input.files[0]) {
        var loadingMsg = document.createElement('div');
        loadingMsg.className = 'loading-message';
        loadingMsg.innerHTML = '<div style="margin: 10px 0;"><div style="display: flex; align-items: flex-start; gap: 4px;"><div style="position: relative; min-width: 36px;"><img src="img/头像.png" style="width: 36px; height: 36px; border-radius: 50%; border: 2px solid #fff; box-shadow: 0 2px 4px rgba(0,0,0,0.1);"><span style="position: absolute; bottom: 0; right: 0; width: 10px; height: 10px; background: #4CAF50; border: 2px solid #fff; border-radius: 50%;"></span></div><div style="flex: 1; width: calc(100% - 40px);"><div style="display: flex; align-items: center; gap: 8px; margin-bottom: 4px;"><span style="font-size: 14px; color: #333; font-weight: 500;">审核员小雨</span><span style="font-size: 12px; color: #4CAF50; background: rgba(76, 175, 80, 0.1); padding: 2px 6px; border-radius: 10px;">在线中</span></div><div style="background: #fff; padding: 10px 12px; border-radius: 4px 12px 12px 12px; box-shadow: 0 1px 2px rgba(0,0,0,0.1); max-width: 98%; word-break: break-word;">正在审核图片，请稍候...</div></div></div></div>';
        document.getElementById('chat_content').appendChild(loadingMsg);
        document.getElementById('chat_content').scrollTop = document.getElementById('chat_content').scrollHeight;
        var formData = new FormData();
        formData.append('file', input.files[0]);        
        // 增加上传图片的计数
        imageUploadCount++;
        // 模拟成功响应
        const mockSuccessResponse = {
            success: true,
            message: `图片上传成功，审核通过！当前已上传 ${imageUploadCount} 张图片，请继续上传剩余 ${3 - imageUploadCount} 张图片`,
            count: imageUploadCount,
            task_completed: true
        };

        // 移除加载消息
        if (loadingMsg) {
            loadingMsg.remove();
        }

        // 创建新的消息元素
        var msgDiv = document.createElement('div');
        msgDiv.style.margin = '10px 0';

        // 添加AI头像和名称
        var msgHtml = '<div style="display: flex; align-items: flex-start; gap: 4px;"><div style="position: relative; min-width: 36px;"><img src="img/头像.png" style="width: 36px; height: 36px; border-radius: 50%; border: 2px solid #fff; box-shadow: 0 2px 4px rgba(0,0,0,0.1);"><span style="position: absolute; bottom: 0; right: 0; width: 10px; height: 10px; background: #4CAF50; border: 2px solid #fff; border-radius: 50%;"></span></div><div style="flex: 1; width: calc(100% - 40px);"><div style="display: flex; align-items: center; gap: 8px; margin-bottom: 4px;"><span style="font-size: 14px; color: #333; font-weight: 500;">审核员小雨</span><span style="font-size: 12px; color: #4CAF50; background: rgba(76, 175, 80, 0.1); padding: 2px 6px; border-radius: 10px;">在线中</span></div>';

        // 添加消息内容
        if (mockSuccessResponse.html_message) {
            // 使用服务器返回的HTML消息
            msgHtml += mockSuccessResponse.html_message;
        } else if (mockSuccessResponse.message) {
            // 使用普通文本消息
            msgHtml += '<div style="background: #fff; padding: 10px 12px; border-radius: 4px 12px 12px 12px; box-shadow: 0 1px 2px rgba(0,0,0,0.1); max-width: 98%; word-break: break-word;">' + mockSuccessResponse.message + '</div>';
        } else if (!mockSuccessResponse.success) {
            // 显示错误消息
            msgHtml += '<div style="background: #fff; padding: 10px 12px; border-radius: 4px 12px 12px 12px; box-shadow: 0 1px 2px rgba(0,0,0,0.1); max-width: 98%; word-break: break-word; color: #f44336;">处理图片时出错: ' + (mockSuccessResponse.error || '未知错误') + '</div>';
        }

        msgHtml += '</div></div>';
        msgDiv.innerHTML = msgHtml;

        // 添加到聊天内容区域
        document.getElementById('chat_content').appendChild(msgDiv);
        document.getElementById('chat_content').scrollTop = document.getElementById('chat_content').scrollHeight;

        // 检查是否有进度信息
        if (mockSuccessResponse.count && mockSuccessResponse.count < 3) {
            console.log("审核进度: " + mockSuccessResponse.count + "/3");
        }

        // 检查是否任务完成
        if (mockSuccessResponse.task_completed) {
            console.log("任务完成!");
        }
        // 当上传图片数量达到5时，触发checkImageAndRespond函数
        if (imageUploadCount === 3) {
            checkImageAndRespond();
        }
    }
}
//原版图片发出没有显示结束
*/

// 从调试信息中提取识别的文本
function extractRecognizedText(debugInfo) {
    const lines = debugInfo.split('\n');
    const textLines = [];
    let captureText = false;
    
    for (let line of lines) {
        if (line.includes('检测到的所有文本:')) {
            captureText = true;
            continue;
        }
        
        if (captureText && line.match(/^\d+\.\s/)) {
            // 提取行号后的文本内容
            const text = line.replace(/^\d+\.\s/, '').trim();
            if (text) {
                textLines.push(text);
            }
        }
        
        if (captureText && line.includes('=====')) {
            captureText = false;
        }
    }
    
    return textLines;
}

// 发送消息
function sendKfMessage() {
    const messageInput = document.getElementById('kf_message_input');
    const message = messageInput.value.trim();
    
    if (message) {
        // 添加用户消息
        addUserMessage(message);
        messageInput.value = '';
        
        // 根据验证状态决定回复内容
        if (lastImageVerified) {
            // 验证通过，使用游戏链接回复
            checkImageAndRespond();
        } else {
            // 验证未通过，提示用户上传符合条件的图片
            addBotResponse('请先上传评论规范截图后<br>即可免费获取所有游戏链接哦！');
        }
    } else {
        // 如果没有文本消息，检查是否有验证通过的图片
        if (lastImageVerified) {
            // 验证通过，使用游戏链接回复
            checkImageAndRespond();
        } else {
            showCustomToast('请输入消息或上传符合要求的图片', 'info');
        }
    }
}

// 添加用户消息到聊天窗口
function addUserMessage(content, isImage = false) {
    const chatContent = document.getElementById('chat_content');
    const messageDiv = document.createElement('div');
    messageDiv.style.margin = '10px 0';
    messageDiv.style.display = 'flex';
    messageDiv.style.justifyContent = 'flex-end';
    
    // 主要消息内容
    let messageHtml = `
        <div style="display: flex; flex-direction: row-reverse; align-items: flex-start; gap: 4px; width: 100%;">
            <div style="flex: 1; display: flex; flex-direction: column; align-items: flex-end; width: 100%;">
                <div style="
                    background: #dcf8c6;
                    padding: 10px 12px;
                    border-radius: 12px 4px 12px 12px;
                    box-shadow: 0 1px 2px rgba(0,0,0,0.1);
                    margin-left: auto;
                    max-width: 98%;
                    word-break: break-word;
                ">
    `;
    
    if (isImage) {
        messageHtml += `<img src="${content}" style="max-width: 100%; max-height: 300px; border-radius: 4px;">`;
    } else {
        messageHtml += content;
    }
    
    messageHtml += `
                </div>
            </div>
        </div>
    `;
    
    messageDiv.innerHTML = messageHtml;
    chatContent.appendChild(messageDiv);
    chatContent.scrollTop = chatContent.scrollHeight;
}

// 添加机器人回复消息
function addBotResponse(message, isGameLinks = false) {
    const chatContent = document.getElementById('chat_content');
    const messageDiv = document.createElement('div');
    messageDiv.style.margin = '10px 0';
    
    // 主要消息内容
    let messageHtml = `
        <div style="display: flex; align-items: flex-start; gap: 4px;">
            <div style="position: relative; min-width: 36px;">
                <img src="img/头像.png" style="width: 36px; height: 36px; border-radius: 50%; border: 2px solid #fff; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                <span style="
                    position: absolute;
                    bottom: 0;
                    right: 0;
                    width: 10px;
                    height: 10px;
                    background: #4CAF50;
                    border: 2px solid #fff;
                    border-radius: 50%;
                "></span>
            </div>
            <div style="flex: 1; width: calc(100% - 40px);">
                <div style="
                    display: flex;
                    align-items: center;
                    gap: 8px;
                    margin-bottom: 4px;
                ">
                    <span style="
                        font-size: 14px;
                        color: #333;
                        font-weight: 500;
                    ">审核员小雨</span>
                    <span style="
                        font-size: 12px;
                        color: #4CAF50;
                        background: rgba(76, 175, 80, 0.1);
                        padding: 2px 6px;
                        border-radius: 10px;
                    ">在线中</span>
                </div>
                <div style="
                    background: #fff;
                    padding: 10px 12px;
                    border-radius: 4px 12px 12px 12px;
                    box-shadow: 0 1px 2px rgba(0,0,0,0.1);
                    max-width: 98%;
                    word-break: break-word;
                ">
    `;
    
    if (isGameLinks) {
        messageHtml += `
            <div style="font-weight: bold; margin-bottom: 8px;">✅ 宝子恭喜你获得资源（一共有3个获取入口，如果其中一个和谐或者没有想看的就换一个渠道）速度保存到自己网盘，因为链接随时失效，3个渠道建议全部保存到自己的网盘，因为每个网盘的资源都不一样</div>
            ${message}
        `;
    } else {
        messageHtml += message;
    }
    
    messageHtml += `
                </div>
            </div>
        </div>
    `;
    
    messageDiv.innerHTML = messageHtml;
    chatContent.appendChild(messageDiv);
    chatContent.scrollTop = chatContent.scrollHeight;
}

// 重置消息通知
function resetMessageNotification() {
    const messageCountElement = document.getElementById('info-num');
    if (messageCountElement) {
        messageCountElement.style.display = 'none';
        messageCountElement.textContent = '0';
    }
    messageCount = 0;
}

// 显示消息通知
function showMessageNotification() {
    messageCount++;
    const messageCountElement = document.getElementById('info-num');
    if (messageCountElement) {
        messageCountElement.style.display = 'block';
        messageCountElement.textContent = messageCount;
    }
}

// 检查图片并做出响应
function checkImageAndRespond() {
    // 重置验证状态，防止重复触发
    lastImageVerified = false;
    
    // 显示加载中状态
    addBotResponse('正在获取游戏链接，请稍候...');
    
    // 从后端API获取游戏链接
    fetch('/api/get-config')
        .then(response => response.json())
            
            // 如果出错，使用默认链接
            const defaultGameLinks = `
                <div class="game-links-container">
                    </a>
                    <a href="#" class="game-link" onclick="window.open('https://pan.quark.cn/s/f17cfe176079');">
                        <span class="game-icon">🔞</span>
                        <span class="game-title">渠道1  夸克网盘800G 同人动漫-漫画</span>
                        <span class="game-arrow">→</span>
                    </a>
                    <a href="#" class="game-link" onclick="window.open('
https://pan.xunlei.com/s/VOYoVTLL9PgZsRofkjwJx4bTA1?pwd=3dar#', '_blank');">
                        <span class="game-icon">🔞</span>
                        <span class="game-title">渠道2  迅雷网盘600G 同人动漫-漫画</span>
                        <span class="game-arrow">→</span>
                    </a>
                    <a href="#" class="game-link" onclick="window.open('941096260', '_blank');">
                        <span class="game-icon">🔞</span>
                        <span class="game-title">资源更新Q群241810056，进群后等通知</span>
                        <span class="game-arrow">→</span>
                    </a>
                </div>
            `;
            
            addBotResponse(`${defaultGameLinks}`, true);
            
            // 显示新消息通知
            showMessageNotification();
}

// 语音通话
function showVoiceCall() {
    showCustomToast('语音功能即将上线，敬请期待', 'info');
}

// 展示个人资料
function show_about_box() {
    alert("AI机器人为您服务");
}

// 打开快手APP或网页
function openKuaishou() {
    // 尝试打开APP
    let appUrl = 'kwai://home';
    let webUrl = 'https://www.kuaishou.com/';
    
    // 创建一个隐藏的iframe尝试打开APP
    let iframe = document.createElement('iframe');
    iframe.style.display = 'none';
    iframe.src = appUrl;
    document.body.appendChild(iframe);
    
    // 设置定时器，如果APP没有打开，则转到网页版
    setTimeout(function() {
        document.body.removeChild(iframe);
        window.location.href = webUrl;
    }, 2000);
    
    // 添加成功消息
    showCustomToast('正在打开快手...', 'success');
}

// 打开抖音APP或网页
function openDouyin() {
    // 尝试打开APP
    let appUrl = 'snssdk1128://';
    let webUrl = 'https://www.douyin.com/';
    
    // 创建一个隐藏的iframe尝试打开APP
    let iframe = document.createElement('iframe');
    iframe.style.display = 'none';
    iframe.src = appUrl;
    document.body.appendChild(iframe);
    
    // 设置定时器，如果APP没有打开，则转到网页版
    setTimeout(function() {
        document.body.removeChild(iframe);
        window.location.href = webUrl;
    }, 2000);
    
    // 添加成功消息
    showCustomToast('正在打开抖音...', 'success');
}

// AI机器人悬浮窗拖动功能
let isDragging = false;
let dragOffsetX = 0;
let dragOffsetY = 0;

// 初始化拖拽功能
function initDraggable() {
    const floatWindow = document.getElementById('iframe_company_mini_div');
    const dragHandle = document.querySelector('.pc-visitor-header');
    
    if (!floatWindow || !dragHandle) return;
    
    // 鼠标按下事件
    dragHandle.addEventListener('mousedown', function(e) {
        isDragging = true;
        dragOffsetX = e.clientX - floatWindow.getBoundingClientRect().left;
        dragOffsetY = e.clientY - floatWindow.getBoundingClientRect().top;
        
        // 添加临时样式
        floatWindow.style.transition = 'none';
    });
    
    // 触摸开始事件（移动设备）
    dragHandle.addEventListener('touchstart', function(e) {
        if (e.touches.length === 1) {
            isDragging = true;
            dragOffsetX = e.touches[0].clientX - floatWindow.getBoundingClientRect().left;
            dragOffsetY = e.touches[0].clientY - floatWindow.getBoundingClientRect().top;
            
            // 添加临时样式
            floatWindow.style.transition = 'none';
        }
    }, { passive: false });
    
    // 鼠标移动事件
    document.addEventListener('mousemove', function(e) {
        if (!isDragging) return;
        
        e.preventDefault();
        moveWindow(e.clientX, e.clientY);
    });
    
    // 触摸移动事件
    document.addEventListener('touchmove', function(e) {
        if (!isDragging || e.touches.length !== 1) return;
        
        e.preventDefault();
        moveWindow(e.touches[0].clientX, e.touches[0].clientY);
    }, { passive: false });
    
    // 鼠标松开事件
    document.addEventListener('mouseup', function() {
        stopDragging();
    });
    
    // 触摸结束事件
    document.addEventListener('touchend', function() {
        stopDragging();
    });
    
    // 当鼠标离开窗口时
    document.addEventListener('mouseleave', function() {
        stopDragging();
    });
}

// 移动窗口
function moveWindow(clientX, clientY) {
    const floatWindow = document.getElementById('iframe_company_mini_div');
    if (!floatWindow) return;
    
    // 计算新位置
    let newLeft = clientX - dragOffsetX;
    let newTop = clientY - dragOffsetY;
    
    // 获取窗口大小
    const windowWidth = window.innerWidth;
    const windowHeight = window.innerHeight;
    const floatWidth = floatWindow.offsetWidth;
    const floatHeight = floatWindow.offsetHeight;
    
    // 限制窗口不超出可视区域
    newLeft = Math.max(0, Math.min(windowWidth - floatWidth, newLeft));
    newTop = Math.max(0, Math.min(windowHeight - floatHeight, newTop));
    
    // 设置新位置
    floatWindow.style.left = newLeft + 'px';
    floatWindow.style.right = 'auto';
    floatWindow.style.top = newTop + 'px';
    floatWindow.style.bottom = 'auto';
}

// 停止拖动
function stopDragging() {
    if (isDragging) {
        const floatWindow = document.getElementById('iframe_company_mini_div');
        if (floatWindow) {
            floatWindow.style.transition = '';
        }
        isDragging = false;
    }
}

// 获取并更新关键词按钮
async function updateKeywordButtons() {
    try {
        const response = await fetch('/api/get-config');
        const data = await response.json();
        
        if (data.success && data.data && data.data.keywords) {
            const keywordButtons = document.querySelector('.keyword-buttons');
            if (keywordButtons) {
                keywordButtons.innerHTML = ''; // 清空现有按钮
                
                // 为每个关键词创建按钮
                data.data.keywords.forEach(keyword => {
                    const button = document.createElement('span');
                    button.className = 'keyword-btn';
                    button.textContent = keyword;
                    button.onclick = () => copyKeyword(keyword);
                    button.onmouseover = () => button.style.transform = 'scale(1.05)';
                    button.onmouseout = () => button.style.transform = 'scale(1)';
                    keywordButtons.appendChild(button);
                });
            }
        }
    } catch (error) {
        console.error('获取关键词失败:', error);
        showCustomToast('获取关键词失败，请刷新页面重试', 'error');
    }
}
window.openModal = function(projectName, projectFiles, projectImage,projectImages) {
    document.getElementById("myModal").style.display = "block";
};
// 同样对 closeModal 函数也这么处理
window.closeModal = function() {
    document.getElementById("myModal").style.display = "none";
};

        window.onclick = function(event) {
            if (event.target == document.getElementById("myModal")) {
                window.closeModal();
            }
        };
        
        
/* 宣传图上面的文字 输入一个词就会替换6个词版开始*/
/*document.addEventListener('DOMContentLoaded', function() {
    // ===== 配置部分 ===== （在这里修改关键词）
    const defaultKeywords = ["火影同人", "动漫推荐", "最新同人", "柯南这一块", "雏田的一天", "权威这一块火影"];
    const masterKeyword = ""; // 在这里输入统一关键词（留空则用默认的6个词）
    // ==================

    // 初始化关键词覆盖层
    const overlay = document.getElementById('keywordOverlay');
    if (overlay) {
        const positions = [
            { top: "25%", left: "34%" },
            { top: "30%", left: "70%" },
            { top: "50%", left: "20%" },
            { top: "60%", left: "60%" },
            { top: "75%", left: "30%" },
            { top: "85%", left: "65%" }
        ];
        
        // 判断使用统一关键词还是默认关键词
        const keywords = masterKeyword ? Array(6).fill(masterKeyword) : defaultKeywords;
        
        keywords.forEach((keyword, index) => {
            const keywordElement = document.createElement('div');
            keywordElement.className = 'keyword-tag';
            keywordElement.textContent = keyword;
            keywordElement.style.top = positions[index].top;
            keywordElement.style.left = positions[index].left;
            // keywordElement.style.transform = `rotate(${Math.random() * 10 - 5}deg)`; // 文字旋转（已注释）
            overlay.appendChild(keywordElement);
        });
    }
});*/
/* 宣传图上面的文字 输入一个词就会替换6个词版结束*/

/* 宣传图上面的文字 文字自定义之后，后面可以追加域名版*/
/**
document.addEventListener('DOMContentLoaded', function() {
    // ===== 配置部分 ===== （在这里修改）
    const defaultKeywords = ["火影这一块", "柯南这一块", "拿走不用谢", "我在用", "桐人这一块", "你能开心就行"];
    const appendKeyword = "347.bar"; // 输入域名（留空则不追加）
    // ==================

    // 初始化关键词覆盖层
    const overlay = document.getElementById('keywordOverlay');
    if (overlay) {
        const positions = [
            { top: "25%", left: "13%" },
            { top: "37%", left: "13%" },
            { top: "49%", left: "13%" },
            { top: "61%", left: "13%" },
            { top: "72%", left: "13%" },
            { top: "85%", left: "13%" }
        ];
        
        // 处理关键词：如果指定了追加词，就在每个关键词后面加上
        const keywords = appendKeyword 
            ? defaultKeywords.map(keyword => `${keyword}${appendKeyword}`)
            : defaultKeywords;
        
        keywords.forEach((keyword, index) => {
            const keywordElement = document.createElement('div');
            keywordElement.className = 'keyword-tag';
            keywordElement.textContent = keyword;
            keywordElement.style.top = positions[index].top;
            keywordElement.style.left = positions[index].left;
            overlay.appendChild(keywordElement);
        });
    }
});*/// 这里放置您原有的所有JavaScript功能代码
// 只需将原来的代码复制到这里即可

// 修改API调用端点使用动态配置
async function fetchKeywords() {
    try {
        const response = await fetch(window.siteConfig.api_endpoints.get_config);
        const data = await response.json();
        return data.keywords;
    } catch (error) {
        console.error('获取关键词失败:', error);
        return window.keywordPool; // 使用PHP提供的默认值
    }
}